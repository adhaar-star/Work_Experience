<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\Portfolio;
use App\Buckets;
use App\Currency;
use App\Portfoliotype;
use Redirect;
use App\category;
use Illuminate\Support\Facades\Input;

class PortfolioGraphicsController extends Controller
{

    public function index($projectId = null, $portfolioId = null)
    {

        $portfolioAll = $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->where('status', 'active')->pluck("name", "id");
        $categories = category::pluck('category_name', 'id')->toArray();
        return view('admin.portfoliocapacityplanning.graphic', compact('portfolioAll', 'categories'));
    }
    
    public function getCapacityPlanningGraphics($id){
        try {
            $filter = Input::get('filter');
            $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->find($id);
            $buckets = Buckets::where('company_id', Auth::user()->company_id)->with('children_rec')->where('portfolio_id', $id)->where('parent_bucket', 0)->get()->toArray();
            $chartData = array(
                'text' => array('name' => strtoupper($portfolio->name)),
                'HTMLclass' => 'orange-graph',
                'stackChildren' => true,
                'children' => array()
            );
            $formatedArray = array();
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
            $url = $protocol.$_SERVER['HTTP_HOST'];
            $bucketList = Buckets::where('company_id', Auth::user()->company_id)->where('is_delete', 'N')->with('children')->with('portfolio')->with('department_name')->with('costcentre_name')->with('currencyname')->get();
            $formatedArray = $this->recursiveBucket($formatedArray, $buckets, $url, $filter);
            $chartData['children'] = $formatedArray;
            
            return response()->json($chartData);
        } catch (Exception $ex) {
            return response()->json('Something went wrong' . $ex->getMessage());
        }
    }
    
    public function recursiveBucket($formatedArray, $buckets, $url, $filter)
    {
        $chartData = $projectArray = $bucketProject = $projects = array();
        
        foreach ($buckets as $key => $value) {
            if(!array_key_exists('project_name', $value)) {
                $projects = Project::projectsByCategory($filter, $value['id']);
                
                $bucketProject = array();
                
                if ($projects && count($projects) > 0 && isset($projects) && !empty($projects)) {
                    $projectArray = $bucketProject = array();
                    foreach ($projects as $p) {
                        $p['name'] = $p['project_name'];
                        $p['children_rec'] = array();
                        if(!array_key_exists('children_rec', $value)){
                          $value['children_rec'] = array();
                        }
                        array_push($value['children_rec'], $p);
                    }
                }
            }
            $bucketResouceCapacity = array('demand' => 0, 'assigned' => 0, 'actual' => 0, 'forecast' => 0,
                'manDemand' => 0, 'manAssigned' => 0, 'manActual' => 0, 'manForecast' => 0);
            $bucketResouceCapacity = Buckets::findBucketCapacity($bucketResouceCapacity, $value, $filter);
            
            $class = 'blue-light';
            $name = '<p class="node-name"><b>' . $value['name'] . ' (' . $value['bucket_id'] . ')' . '<b></p>';
            $name.= '<p class="node-desc"><strong class="padding-left-50"><u>Projects</u></strong> <span class="fw-400 margin-left-5"></span> <span class="pull-right"><strong><u>Manual</u></strong></span> </p>';
            $name.= '<p class="node-desc"><strong>Demand:</strong> <span class="fw-400 margin-left-10"> '.$bucketResouceCapacity['demand'].'</span> <span class="pull-right text-center width-50">'.$bucketResouceCapacity['manDemand'].'</span></p>';
            $name.= '<p class="node-desc"><strong>Assigned:</strong> <span class="fw-400 margin-left-5">'.$bucketResouceCapacity['assigned'].'</span><span class="pull-right text-center width-50">'.$bucketResouceCapacity['manAssigned'].'</span> </p>';
            $name.= '<p class="node-desc"><strong>Actual:</strong> <span class="fw-400 margin-left-20">'.$bucketResouceCapacity['actual'].'</span> <span class="pull-right text-center width-50">'.$bucketResouceCapacity['manActual'].'</span></p>';
            $name.= '<p class="node-desc"><strong>Forecast:</strong> <span class="fw-400 margin-left-10">'.$bucketResouceCapacity['forecast'].'</span> <span class="pull-right text-center width-50">'.$bucketResouceCapacity['manForecast'].'</span></p>';
            $linkType = $url.'/admin/buckets/'.$value['id'];
            
            if (array_key_exists('project_name', $value)) {
                $class = 'yellow-light-graph';
                $projectResourceCap = Buckets::projectCapacityResource($value['id']);
                
                $name = '<p class="node-name"><b>' . $value['name']. ' (' . $value['project_Id'] . ')'. '<b></p>';
                $name.= '<p class="node-desc text-center"><strong>Demand:</strong> <span class="fw-400 margin-left-10">'.$projectResourceCap['demand'].'</span></p>';
                $name.= '<p class="node-desc text-center"><strong>Assigned:</strong> <span class="fw-400 margin-left-5">'.$projectResourceCap['assigned'].'</span></p>';
                $name.= '<p class="node-desc text-center"><strong>Actual:</strong> <span class="fw-400 margin-left-20">'.$projectResourceCap['actual'].'</span></p>';
                $name.= '<p class="node-desc text-center"><strong>Forecast:</strong> <span class="fw-400 margin-left-10">'.$projectResourceCap['forecast'].'</span></p>';
                
//                $name = $value['name']. ' (' . $value['project_Id'] . ')';;
                $value['description'] = $value['project_desc'];
                $linkType = $url.'/admin/projectStructure/'.$value['id'];
            }
            $chartBuckets = array(
            'innerHTML' => $name,    
            'HTMLclass' => $class,
            'stackChildren' => true,
            'link' => array('href' => $linkType),   
//            'children' => array()
            );
            
            $children = array();
            if(array_key_exists('children_rec', $value)){
              $children = $this->recursiveBucket($buckets, $value['children_rec'], $url, $filter);
            }
            if ($children) {
                if (count($projectArray) > 0){
                    $children = array_merge($children, $projectArray);
                }
                $chartBuckets['children'] = $children;
            }

            $chartData[] = $chartBuckets;
        }
        return $chartData;
    }

}
