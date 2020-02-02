<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Currency;
use App\quantitative_risk_analysis;
use App\qualitative_risk_analysis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\QualitativeMatrix;
use App\User;
use App\Quantitative_riskscore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Roleauth;
use App\Helpers\RoleAuthHelper;

class RiskAnalysisController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    Roleauth::check('risk.all.index');

    $qualitativeData = qualitative_risk_analysis::where('company_id', Auth::user()->company_id)->get();
    foreach ($qualitativeData as $key => $value) {
      $qual_createdby[$key] = $value['qual_created_by'] != '' ? User::where('id', $value['qual_created_by'])->first()['original']['name'] : '';
      $qual_changedby[$key] = $value['qual_changed_by'] != '' ? User::where('id', $value['qual_changed_by'])->first()['original']['name'] : '';

      $qual_createdon[$key] = date("Y-m-d", strtotime($value['created_at']));

      $updated_date = isset($value['updated_at']) ? $value['updated_at'] : '';
      if (empty($updated_date)) {
        $qual_updatedon[$key] = null;
      } else {
        $qual_updatedon[$key] = date("Y-m-d", strtotime($updated_date));
      }
    }
    $data = DB::table('qualitative_matrix as q1')
      ->orderBy('qr.id')
      ->select('q1.risk_score')
      ->leftjoin('qualitative_risk_analysis as qr', 'q1.qualitative_likelihood', '=', 'qr.qual_likelihood')
      ->whereColumn([
          ['q1.qualitative_likelihood', '=', 'qr.qual_likelihood'],
          ['q1.qualitative_consequence', '=', 'qr.qual_consequence']
      ])
      ->where('q1.company_id', Auth::user()->company_id)
      ->get();

    $score = array();
    foreach ($data as $value1) {
      $score[] = isset($value1->risk_score) ? $value1->risk_score : '';
    }

    //for quantitative
    $quantitativeData = DB::table('quantitative_risk_analysis')
      ->select('quantitative_risk_analysis.*', 'currencies.short_code')
      ->leftjoin('currencies', 'quantitative_risk_analysis.quan_currency', '=', 'currencies.id')
      ->where('quantitative_risk_analysis.company_id', Auth::user()->company_id)
      ->get();
    foreach ($quantitativeData as $key1 => $quan_value1) {
      $quan_createdby[$key1] = $quan_value1->quan_created_by != '' ? User::where('id', $quan_value1->quan_created_by)->first()['original']['name'] : '';
      $quan_changedby[$key1] = $quan_value1->quan_changed_by != '' ? User::where('id', $quan_value1->quan_changed_by)->first()['original']['name'] : '';

      $quan_createdon[$key1] = date("Y-m-d", strtotime($quan_value1->created_at));

      $updated_date = isset($quan_value1->updated_at) ? $quan_value1->updated_at : '';
      if (empty($updated_date)) {
        $quan_updatedon[$key1] = null;
      } else {
        $quan_updatedon[$key1] = date("Y-m-d", strtotime($updated_date));
      }
    }

    return view('admin.riskAnalysis.new_index', compact('quantitativeData', 'score', 'qualitativeData', 'quan_createdby', 'quan_changedby', 'qual_createdby', 'qual_changedby', 'qual_createdon', 'quan_createdon', 'quan_updatedon', 'qual_updatedon'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function createQualitative() {
    Roleauth::check('risk.qualitative.create');

    //get project id and its description
    $project = DB::table('project')
      ->where('company_id', Auth::user()->company_id)
      ->get();

    $project_id = array();
    foreach ($project as $projectid) {

      $project_id[$projectid->project_Id] = $projectid->project_Id . ' ( ' . $projectid->project_desc . ' )';
    }

    return view('admin.qualitative_risk.risk_analysis', compact('project_id'));
  }

  public function createQuantitative() {
    Roleauth::check('risk.quantitative.create');

    //get currency
    $currency = array();
    $temp = null;
    $temp = Currency::where('company_id', Auth::user()->company_id)->get();
    foreach ($temp as $value) {
      $currency[$value['id']] = $value['short_code'];
    }

    //get project id and its description
    $project = DB::table('project')
      ->where('company_id', Auth::user()->company_id)
      ->get();

    $project_id = array();
    foreach ($project as $projectid) {

      $project_id[$projectid->project_Id] = $projectid->project_Id . ' ( ' . $projectid->project_desc . ' )';
    }
    return view('admin.quantitative_risk.risk_analysis', compact('currency', 'project_id'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request            
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    Roleauth::check('risk.qualitative.create');

    $qualitative_data = Input::all();
    //get user id
    $user = \Auth::User()->id;
    //get company id
    $company_id = \Auth::User()->company_id;
    $qualitative_data['qual_created_by'] = $user;
    $qualitative_data['company_id'] = $company_id;
    $qualitative_data['risk_type'] = 'Qualitative';
    $qualitative_data['created_at'] = date('Y-m-d h:m:s');
    //serverside validation
    $validator = qualitative_risk_analysis::validateQualitative($qualitative_data);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('/admin/qualitative_risk')->withErrors($validator)->withInput(Input::all());
    }

    qualitative_risk_analysis::create($qualitative_data);
    session()->flash('flash_message', 'Qualitative Risk created successfully...');
    return redirect('admin/riskregister');
  }

  public function storeQuantitative(Request $request) {
    Roleauth::check('risk.quantitative.create');

    $quantitative_data = Input::all();
    //get user id
    $user = \Auth::User()->id;
    //get company id
    $company_id = \Auth::User()->company_id;
    $quantitative_data['quan_created_by'] = $user;
    $quantitative_data['company_id'] = $company_id;
    $quantitative_data['risk_type'] = 'Quantitative';
    $quantitative_data['created_at'] = date('Y-m-d h:m:s');

    //serverside validation
    $validator = quantitative_risk_analysis::validateQuantitative($quantitative_data);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('/admin/quantitative_risk')->withErrors($validator)->withInput(Input::all());
    }

    quantitative_risk_analysis::create($quantitative_data);
    session()->flash('flash_message', 'Quantitative Risk created successfully...');
    return redirect('admin/riskregister');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    Roleauth::check('risk.qualitative.edit');

    $qualitative_data = qualitative_risk_analysis::where('company_id', Auth::user()->company_id)->find($id);
    $createdby = $qualitative_data['qual_created_by'] != '' ? User::where('id', $qualitative_data['qual_created_by'])->first()['original']['name'] : '';
    $changedby = $qualitative_data['qual_changed_by'] != '' ? User::where('id', $qualitative_data['qual_changed_by'])->first()['original']['name'] : '';

    $createdon = date("Y-m-d", strtotime($qualitative_data['created_at']));

    $updated_date = isset($qualitative_data['updated_at']) ? $qualitative_data['updated_at'] : '';
    if (empty($updated_date)) {
      $updatedon = null;
    } else {
      $updatedon = date("Y-m-d", strtotime($updated_date));
    }

    $risk_score = array();
    $projectID = $qualitative_data['project_id'];
    $allrisk_score = DB::table('qualitative_risk_analysis')
      ->select('qualitative_risk_analysis.risk_score')
      ->where('project_id', $projectID)
      ->where('company_id', Auth::user()->company_id)
      ->get();
    foreach ($allrisk_score as $key => $value) {
      $risk_score[] = $value->risk_score;
    }

    $total_risk = array_sum($risk_score);
    $current_riskscore = $total_risk - $qualitative_data['risk_score'];
    //get project id and its description
    $project = DB::table('project')
      ->where('company_id', Auth::user()->company_id)
      ->get();

    $project_id = array();
    foreach ($project as $projectid) {

      $project_id[$projectid->project_Id] = $projectid->project_Id . ' ( ' . $projectid->project_desc . ' )';
    }
    return view('admin.qualitative_risk.risk_analysis', compact('updatedon', 'createdon', 'changedby', 'createdby', 'total_risk', 'current_riskscore', 'qualitative_data', 'project_id'));
  }

  public function editQuantitative($quanId) {
    Roleauth::check('risk.quantitative.edit');

    $quantitativeData = DB::table('quantitative_risk_analysis')->where('quan_id', '=', $quanId)->where('company_id', Auth::user()->company_id)->first();
    $createdby = $quantitativeData->quan_created_by != '' ? User::where('id', $quantitativeData->quan_created_by)->first()['original']['name'] : '';
    $changedby = $quantitativeData->quan_changed_by != '' ? User::where('id', $quantitativeData->quan_changed_by)->first()['original']['name'] : '';

    $createdon = date("Y-m-d", strtotime($quantitativeData->created_at));

    $updated_date = isset($quantitativeData->updated_at) ? $quantitativeData->updated_at : '';
    if (empty($updated_date)) {
      $updatedon = null;
    } else {
      $updatedon = date("Y-m-d", strtotime($updated_date));
    }

    //get currency
    $currency = array();
    $temp = null;
    $temp = Currency::where('company_id', Auth::user()->company_id)->get();
    foreach ($temp as $value) {
      $currency[$value['id']] = $value['short_code'];
    }

    $loss = array();
    $projectID = $quantitativeData->project_id;
    $expected_loss = DB::table('quantitative_risk_analysis')
      ->select('quantitative_risk_analysis.quan_expected_loss')
      ->where('project_id', $projectID)
      ->where('company_id', Auth::user()->company_id)
      ->get();
    foreach ($expected_loss as $key => $value) {
      $loss[] = $value->quan_expected_loss;
    }

    $total_loss = array_sum($loss);
    $all_projectloss = $total_loss - $quantitativeData->quan_expected_loss;
    //get project id and its description
    $project = DB::table('project')
      ->where('company_id', Auth::user()->company_id)
      ->get();

    $project_id = array();
    foreach ($project as $projectid) {

      $project_id[$projectid->project_Id] = $projectid->project_Id . ' ( ' . $projectid->project_desc . ' )';
    }
    return view('admin.quantitative_risk.risk_analysis', compact('all_projectloss', 'currency', 'updatedon', 'createdon', 'changedby', 'createdby', 'quantitativeData', 'project_id'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request            
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    Roleauth::check('risk.qualitative.edit');

    $qualitativeId = qualitative_risk_analysis::where('company_id', Auth::user()->company_id)->find($id);
    $qualitativeInputs = Input::all();
    //get user id
    $user = \Auth::User()->id;
    $qualitativeInputs['qual_changed_by'] = $user;
    $qualitativeInputs['updated_at'] = date('Y-m-d h:m:s');
    //serverside validation
    $validator = qualitative_risk_analysis::validateQualitative($qualitativeInputs);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('/admin/qualitative_risk/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
    }

    $qualitativeId->update($qualitativeInputs);
    session()->flash('flash_message', 'Qualitative Risk updated successfully...');
    return redirect('admin/riskregister');
  }

  public function updateQuantitative(Request $request, $quanId) {
    Roleauth::check('risk.quantitative.edit');

    $quantitativeId = DB::table('quantitative_risk_analysis')->where('quan_id', '=', $quanId)->where('company_id', Auth::user()->company_id)->first();

    $quantitativeInputs = Input::except('_method', '_token', 'created_on', 'created_by');
    //get user id
    $user = \Auth::User()->id;
    $quantitativeInputs['quan_changed_by'] = $user;
    $quantitativeInputs['updated_at'] = date('Y-m-d h:m:s');

    //serverside validation
    $validator = quantitative_risk_analysis::validateQuantitative($quantitativeInputs);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('/admin/quantitative_risk/' . $quanId . '/edit')->withErrors($validator)->withInput(Input::all());
    }

    DB::table('quantitative_risk_analysis')
      ->where('quan_id', $quantitativeId->quan_id)
      ->where('company_id', Auth::user()->company_id)
      ->update($quantitativeInputs);

    session()->flash('flash_message', 'Quantitative Risk updated successfully...');
    return redirect('admin/riskregister');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function deleteQualitative($id) {
    Roleauth::check('risk.qualitative.edit');

    qualitative_risk_analysis::where('id', $id)->where('company_id', Auth::user()->company_id)->delete();
    session()->flash('flash_message', 'Qualitative Risk deleted successfully...');
    return response()->json(['status' => 'msg', 'data' => 'Qualitative Risk deleted successfully...']);
  }

  public function deleteQuantitative($quanId) {
    Roleauth::check('risk.quantitative.edit');

    DB::table('quantitative_risk_analysis')->where('quan_id', '=', $quanId)->where('company_id', Auth::user()->company_id)->delete();
    session()->flash('flash_message', 'Quantitative Risk deleted successfully...');
    return response()->json(['status' => 'msg', 'data' => 'Quantitative Risk deleted successfully...']);
  }

  public function getProjectDesc($pid) {
    //get project description based on project id
    $projectData = DB::table('project')
      ->select('project.*', 'portfolio.name as portfolioname', 'buckets.name as bucketname')
      ->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id')
      ->leftjoin('buckets', 'buckets.id', '=', 'project.bucket_id')
      ->where('project.project_Id', $pid)
      ->where('project.company_id', Auth::user()->company_id)
      ->first();
    return response()->json(['status' => true, 'data' => $projectData]);
  }

  public function addMatrix() {

    $qualitativeriskscore_data = QualitativeMatrix::all();
    return view('admin.riskAnalysis.addMatrix', compact('qualitativeriskscore_data'));
  }

  public function updateQualitativeRiskScore(Request $request, $id) {
    $qualitativeId = QualitativeMatrix::where('company_id', Auth::user()->company_id)->find($id);
    $qualitativeId->update(['risk_score' => $request->risk_score]);
    return Response::json([
          'flash_message' => 'Qualitative Risk Score Updated successfully...']);
  }

  public function getRiskScore($impact, $probability) {
    //get risk score based on impact and probability
    $riskScoreData = QualitativeMatrix::where('qualitative_likelihood', $impact)
      ->where('qualitative_consequence', $probability)
      ->first();
    return response()->json(['status' => true, 'data' => $riskScoreData]);
  }

  public function getQuantitativeRiskScore($expectedloss) {
    $risk = DB::table('quantitative_riskscore')->MAX('end_range');
    if ($risk < intval($expectedloss)) {
      return response()->json(['status' => 'msg', 'data' => 'Expected loss is out of range. Please change your quantitative risk score range first.']);
    }
    $risk_score = array();
    $riskScore = DB::table('quantitative_riskscore as qr')
      ->where(function ($query) use ($expectedloss) {
        $query->where('qr.start_range', '<=', intval($expectedloss))
        ->where('qr.end_range', '>=', intval($expectedloss));
      })
      ->get();

    foreach ($riskScore as $key => $value) {
      $risk_score = $value;
    }
    return response()->json(['status' => true, 'data' => $risk_score]);
  }

  public function QuantitativeRiskScore() {

    $quantitative_riskscoredata = Quantitative_riskscore::all();
    return view('admin.quantitative_risk.quantitaive_riskscore', compact('quantitative_riskscoredata'));
  }

  public function updateQuantitaiveRiskScore(Request $request, $id) {
    $data = Quantitative_riskscore::find($id);
    $dataInputs = Input::all();
    $data->update($dataInputs);
    session()->flash('flash_message', 'Quantitative Risk Score updated successfully...');
    return redirect('admin/QuantitativeRiskScore');
  }

  public function data_table() {

    $qualitativeData = qualitative_risk_analysis::where('company_id', Auth::user()->company_id)->get()->toArray();
    $data = DB::table('qualitative_matrix as q1')
      ->orderBy('qr.id')
      ->select('q1.risk_score')
      ->leftjoin('qualitative_risk_analysis as qr', 'q1.qualitative_likelihood', '=', 'qr.qual_likelihood')
      ->whereColumn([
          ['q1.qualitative_likelihood', '=', 'qr.qual_likelihood'],
          ['q1.qualitative_consequence', '=', 'qr.qual_consequence']
      ])
      ->get();

    $score = array();
    foreach ($data as $value1) {
      $score[] = isset($value1->risk_score) ? $value1->risk_score : '';
    }

    foreach ($qualitativeData as $key => $value) {
      $qualitativeData[$key]['score'] = isset($score[$key]) ? $score[$key] : '';
    }
    $quantitativeData = DB::table('quantitative_risk_analysis')
        ->select('quantitative_risk_analysis.quan_risk_score as risk_score', 'quantitative_risk_analysis.status as qual_status', 'quantitative_risk_analysis.quan_risk_id as qual_risk_id', 'quantitative_risk_analysis.quan_category as qual_category', 'quantitative_risk_analysis.quan_risk_desc as qual_risk_desc', 'quantitative_risk_analysis.quan_id as id', 'quantitative_risk_analysis.*')
        ->leftjoin('currencies', 'quantitative_risk_analysis.quan_currency', '=', 'currencies.id')
        ->where('quantitative_risk_analysis.company_id', Auth::user()->company_id)
        ->get()->toArray();
    $allRisk = array_merge((array) json_decode(json_encode($qualitativeData), true), (array) json_decode(json_encode($quantitativeData), true));

    return DataTables::of($allRisk)
        ->editColumn('risk_type', function ($allRisk) {
          if ($allRisk['risk_type'] == 'Qualitative')
            return '<span class="label label-success" style="min-width:100px;">Qualitative</span>';
          else
            return '<span class="label label-info" style="min-width:100px;">Quantitative</span>';
        })
        ->editColumn('qual_category', function ($allRisk) {
          if ($allRisk['qual_category'] == '1')
            return 'Supplier risk';
          elseif ($allRisk['qual_category'] == '2')
            return 'Technology risk';
          elseif ($allRisk['qual_category'] == '3')
            return 'Infrastructure risk';
          elseif ($allRisk['qual_category'] == '4')
            return 'Government Policy risk';
          else
            return 'Resource risk';
        })
        ->addColumn('risk_score_status', function ($allRisk) {
          if ($allRisk['risk_type'] == 'Qualitative') {
            if (!empty($allRisk['score'])) {
              if ($allRisk['score'] == 'Low')
                return '<label class="label label-success" style="text-align:center;width:80px;" title="Low" >Low</label>';
              elseif ($allRisk['score'] == 'Medium')
                return '<label class="label label-warning" style="text-align:center;width:80px;" title="Medium" >Medium</label>';
              elseif ($allRisk['score'] == 'High')
                return '<label class="label label-danger"  style="text-align:center;width:80px;" title="High" >High</label>';
            }
            else {
              return '';
            }
          } else {
            if ($allRisk['risk_score'] <= 2)
              return '<label class="label label-success" style="text-align:center;width:80px;" title="Low" >Low</label>';
            if ($allRisk['risk_score'] == 3)
              return '<label class="label label-warning" style="text-align:center;width:80px;" title="Medium" >Medium</label>';
            if ($allRisk['risk_score'] >= 4)
              return '<label class="label label-danger"  style="text-align:center;width:80px;" title="High" >High</label>';
          }
        })
        ->addColumn('action', function ($allRisk) {
          if ($allRisk['risk_type'] == 'Qualitative') {
            $actionButton = (RoleAuthHelper::hasAccess('qualitative_risk.view') != true) ? ' <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-eye" aria-hidden="true"></i>' : '<a title="View" href="javascript:void(0)" data-type="qualitative_risk" data-id=' . $allRisk['id'] . ' class="viewRisk btn btn-info btn-xs  margin-right-1"><i class="fa fa-eye "></i> </a>';
            $actionButton .= (RoleAuthHelper::hasAccess('qualitative_risk.update') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-pencil"></i>' : '<a  href="' . route('qualitative_risk.view', [$allRisk['id'] . '/edit']) . '"  title="Edit" class="btn btn-primary btn-xs  margin-right-1 "><i class="fa fa-edit"></i></a>';
            $actionButton .= (RoleAuthHelper::hasAccess('qualitative_risk.delete') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-trash"></i>' : '<a title="Delete" href="javascript:void(0)" data-type="qualitative_risk" data-id=' . $allRisk['id'] . ' class="deleteRisk btn btn-danger btn-xs margin-right-1"><i class="fa fa-trash"></i></a>';
            return $actionButton;
          } else {
            $actionButton = (RoleAuthHelper::hasAccess('quantitative_risk.view') != true) ? ' <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-eye" aria-hidden="true"></i>' : '<a title="View" href="javascript:void(0)" data-type="quantitative_risk" data-id=' . $allRisk['id'] . ' class="viewRisk btn btn-info btn-xs  margin-right-1"><i class="fa fa-eye"></i> </a>';
            $actionButton .= (RoleAuthHelper::hasAccess('quantitative_risk.update') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-pencil"></i>' : '<a  href="' . route('quantitative_risk.view', $allRisk['id'] . '/edit') . '"  title="Edit" class="btn btn-primary btn-xs  margin-right-1 "><i class="fa fa-edit"></i> </a>';
            $actionButton .= (RoleAuthHelper::hasAccess('quantitative_risk.delete') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-trash"></i>' : '<a title="Delete" href="javascript:void(0)" data-type="quantitative_risk" data-id=' . $allRisk['id'] . ' class="deleteRisk btn btn-danger btn-xs margin-right-1"><i class="fa fa-trash"></i></a>';
            return $actionButton;
          }
        })
        ->addColumn('context', function ($allRisk) {
          if ($allRisk['risk_type'] == 'Qualitative') {
            return '<a  href="' . route('qualitativerisk.update', $allRisk['id']) . '"  title="Edit" class="btn btn-primary btn-xs  margin-right-1 "><i class="fa fa-edit"></i> </a>';
          } else {
            return '<a  href="' . route('quantitativerisk.update', $allRisk['id']) . '"  title="Edit" class="btn btn-primary btn-xs  margin-right-1 "><i class="fa fa-edit"></i> </a>';
          }
        })
        ->editColumn('qual_risk_id', function ($allRisk) {
          if ($allRisk['risk_type'] == 'Qualitative')
            return '<a title="View" href="javascript:void(0)" data-type="qualitative_risk" data-id=' . $allRisk['id'] . ' class="viewRisk">' . $allRisk['qual_risk_id'] . '</a>';
          else
            return '<a title="View" href="javascript:void(0)" data-type="quantitative_risk" data-id=' . $allRisk['id'] . ' class="viewRisk">' . $allRisk['qual_risk_id'] . '</a>';
        })
        ->editColumn('qual_status', function ($allRisk) {
          if ($allRisk['qual_status'] == 'Created')
            return '<label class="label label-warning " style="width:100px;">' . $allRisk['qual_status'] . '</label>';
          else if ($allRisk['qual_status'] == 'Closed')
            return '<label class="label label-danger " style="width:100px;">' . $allRisk['qual_status'] . '</label>';
          else if ($allRisk['qual_status'] == 'In Progress')
            return '<label class="label label-success " style="width:100px;">' . $allRisk['qual_status'] . '</label>';
        })
        ->rawColumns(['risk_score_status', 'qual_category', 'risk_type', 'action', 'context','qual_risk_id', 'qual_status'])
        ->make();
  }

  public function getQuantitativeData($id) {
    //for quantitative

    $quantitativeData = DB::table('quantitative_risk_analysis')
      ->select('quantitative_risk_analysis.*', 'currencies.short_code')
      ->leftjoin('currencies', 'quantitative_risk_analysis.quan_currency', '=', 'currencies.id')
      ->where('quantitative_risk_analysis.company_id', Auth::user()->company_id)
      ->where('quantitative_risk_analysis.quan_id', "=", $id)
      ->first();
    $quantitativeData->created_by = $quantitativeData->quan_created_by != '' ? User::where('id', $quantitativeData->quan_created_by)->first()['original']['name'] : '';
    $quantitativeData->changed_by = $quantitativeData->quan_changed_by != '' ? User::where('id', $quantitativeData->quan_changed_by)->first()['original']['name'] : '';
    $quantitativeData->created_on = date("d-m-Y", strtotime($quantitativeData->created_at));

    $updated_date = isset($quantitativeData->updated_at) ? $quantitativeData->updated_at : '';
    if (empty($updated_date)) {
      $quantitativeData->updated_on = null;
    } else {
      $quantitativeData->updated_on = date("d-m-Y", strtotime($updated_date));
    }

    return response()->json(['data' => $quantitativeData]);
  }

  public function getQualitativeData($id) {


    $qualitativeData = qualitative_risk_analysis::where('company_id', Auth::user()->company_id)
      ->where('id', "=", $id)
      ->first();

    $qualitativeData->qual_createdby = $qualitativeData['qual_created_by'] != '' ? User::where('id', $qualitativeData['qual_created_by'])->first()['original']['name'] : '';
    $qualitativeData->qual_changedby = $qualitativeData['qual_changed_by'] != '' ? User::where('id', $qualitativeData['qual_changed_by'])->first()['original']['name'] : '';

    $qualitativeData->qual_createdon = date("d-m-Y", strtotime($qualitativeData['created_at']));

    $updated_date = isset($qualitativeData['updated_at']) ? $qualitativeData['updated_at'] : '';
    if (empty($updated_date)) {
      $qualitativeData->qual_updatedon = null;
    } else {
      $qualitativeData->qual_updatedon = date("d-m-Y", strtotime($updated_date));
    }

    return response()->json(['data' => $qualitativeData]);
  }

  public function mailtemplate() {
    return view('email.st_works.email_template');
  }

  public function editQuantitativeContext($id) {
    $quantitative_data = DB::table('quantitative_risk_analysis')->where('quan_id', '=', $id)->where('company_id', Auth::user()->company_id)->first();
    return view('admin.quantitative_risk.editContext', compact('quantitative_data'));
  }

  public function editQualitativeContext($id) {
    $qualitative_data = qualitative_risk_analysis::where('company_id', Auth::user()->company_id)->find($id);
    return view('admin.qualitative_risk.editContext', compact('qualitative_data'));
  }

  public function updateQualitativeContext(Request $request, $id) {
    $data = qualitative_risk_analysis::find($id);
    $dataInputs = Input::all();
    //serverside validation
    $validator = qualitative_risk_analysis::validateQualitativeContext($dataInputs);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('/admin/qualitativeriskContext/' . $id . '/edit')->withErrors($validator)->withInput($dataInputs);
    }
    $data->update($dataInputs);
    session()->flash('flash_message', 'Qualitative risk context updated successfully...');
    return redirect('admin/riskregister');
  }

  public function updateQuntitativeContext(Request $request, $id) {
    $quantitativeId = DB::table('quantitative_risk_analysis')->where('quan_id', '=', $id)->where('company_id', Auth::user()->company_id)->first();
    $quantitativeInputs = Input::except('_method', '_token', 'files');
    //serverside validation
    $validator = quantitative_risk_analysis::validateQuantitativeContext($quantitativeInputs);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('/admin/quantitativeriskContext/' . $id . '/edit')->withErrors($validator)->withInput($quantitativeInputs);
    }
    DB::table('quantitative_risk_analysis')
      ->where('quan_id', $quantitativeId->quan_id)
      ->update($quantitativeInputs);
    session()->flash('flash_message', 'Quantitative risk context updated successfully...');
    return redirect('admin/riskregister');
  }

}
