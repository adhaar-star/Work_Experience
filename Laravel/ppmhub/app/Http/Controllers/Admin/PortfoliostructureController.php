<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Portfolio;
use App\Currency;
use App\Portfoliotype;
use App\Buckets;
use App\Project;
use Redirect;
use App\Roleauth;

class PortfolioStructureController extends Controller
{

    public function index($projectId = null, $portfolioId = null)
    {
        Roleauth::check('portfolio.structure.index');
        
        $portfolioAll = Portfolio::where('company_id', Auth::user()->company_id)->get();
        $id = '8';
        $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->find($id);
        if (!empty($portfolio)) {
            $buckets = Buckets::where('company_id', Auth::user()->company_id)->find($portfolio->buckets);
            $subbuckets = Buckets::where('company_id', Auth::user()->company_id)->with('children')->where('parent_bucket', $portfolio->buckets)->get();
        }
        
        $project = Project::where('company_id', Auth::user()->company_id)->get();

        return view('admin.portfolioStructure.index', compact('portfolioAll', 'portfolio', 'buckets', 'subbuckets', 'project', 'portfolioId'));
    }

    public function getpackages()
    {

        $portfolioAll = Portfolio::where('company_id', Auth::user()->company_id)->get();
        $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->find($id);
        $buckets = Buckets::where('company_id', Auth::user()->company_id)->find($portfolio->buckets);
        $subbuckets = Buckets::where('company_id', Auth::user()->company_id)->with('children')->where('parent_bucket', $portfolio->buckets)->get();

        $project = Project::where('company_id', Auth::user()->company_id)->get();

        return view('admin.portfolioStructure.index', compact('portfolioAll', 'portfolio', 'buckets', 'subbuckets', 'project'));
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {


        $portfolioAll = Portfolio::where('company_id', Auth::user()->company_id)->get();
        $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->find($id);
        $buckets = Buckets::where('company_id', Auth::user()->company_id)->find($portfolio->buckets);
        $subbuckets = Buckets::where('company_id', Auth::user()->company_id)->with('children')->where('parent_bucket', $portfolio->buckets)->get();
        $project = Project::where('company_id', Auth::user()->company_id)->get();



        return view('admin.portfolioStructure.index', compact('portfolioAll', 'portfolio', 'buckets', 'subbuckets', 'project'));
    }

    /**
     * Get Portfolio structure data to show as tree
     */
    public function getPortfolioStructure($id)
    {
        try {
            $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->find($id);
            $buckets = Buckets::where('company_id', Auth::user()->company_id)->with('children_rec')->where('portfolio_id', $id)->where('parent_bucket', 0)->get()->toArray();
            $chartData = array(
                'text' => array('name' => strtoupper($portfolio->name)),
                'HTMLclass' => 'orange',
                'children' => array()
            );
            $formatedArray = array();
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
            $url = $protocol.$_SERVER['HTTP_HOST'];
            $bucketList = Buckets::where('company_id', Auth::user()->company_id)->where('is_delete', 'N')->with('children')->with('portfolio')->with('department_name')->with('costcentre_name')->with('currencyname')->get();
            $bucketArray = Buckets::bucketDemand($bucketList);
            $formatedArray = $this->recursiveBucket($formatedArray, $buckets, $url, $bucketArray);
            $chartData['children'] = $formatedArray;
            return response()->json($chartData);
        } catch (Exception $ex) {
            return response()->json('Something went wrong' . $ex->getMessage());
        }
    }

    public function recursiveBucket($formatedArray, $buckets, $url, $bucketList)
    {
        $chartData = array();

        $projectArray = array();
        $bucketProject = $project = array();
        foreach ($buckets as $key => $value) {
            if(!array_key_exists('project_name', $value)) {
                $project = Project::where('company_id', Auth::user()->company_id)->Where('bucket_id', $value['id'])->get()->toArray();
                $bucketProject = array();

                if ($project && count($project) > 0 && isset($project) && !empty($project)) {

                    $projectArray = array();
                    $bucketProject = array();
                    foreach ($project as $p) {
                        $p['name'] = $p['project_name'];
                        $p['children_rec'] = array();
                        if(!array_key_exists('children_rec', $value)){
                          $value['children_rec'] = array();
                        }
                        array_push($value['children_rec'], $p);
                    }
                }
            }
            
            $class = 'yellow';
            $name = $value['name'] . ' (' . $value['bucket_id'] . ')';
            $linkType = $url.'/admin/buckets/'.$value['id'];
            $capacityArr = [];
            if (array_key_exists('project_name', $value)) {
                $class = 'green';
                $name = $value['name']. ' (' . $value['project_Id'] . ')';;
                $value['description'] = $value['project_desc'];
                $linkType = $url.'/admin/projectStructure/'.$value['id'];
            }else{
                if(array_key_exists($value['id'], $bucketList)){
                    $capacityArr = [];
                    if(array_key_exists('children', $bucketList[$value["id"]])){
                        $capacityData = $bucketList[$value["id"]]['children'];
//                       echo 'INNNNNNNNNN';
                        $catArray = array();
//                        print_r($capacityData);
                        foreach($capacityData as $capKey => $capVal){
                            $total = 0;
                            $categoryArr = array();
                            foreach($capVal as $catKey => $catVal){
//                                print_r($catKey);
                                $catArray = array(
                                    'text' => array('name' => strtoupper($catKey)."(".$catVal.")", 'desc' =>''),
                                    'HTMLclass' => 'dark-purple',
                                    'children' => array() 
                                );
                                $categoryArr[] = $catArray;
                                $total+=$catVal;   
                            }
//                            echo '*****';
                            
                            $chartArray = array(
                                'text' => array('name' => strtoupper($capKey), 'desc' =>'Task Demand ('.$total.')'),
                                'HTMLclass' => 'sky-blue',
                                'children' => array() 
                            );
                            $chartArray['children'] = $categoryArr;
//                            print_r($chartArray);
                            $capacityArr[] = $chartArray;
                        }
//                        echo 'Capcity Array'.PHP_EOL;
//                        print_r($capacityArr);  
                    }
//                    print_r($bucketList[$value["id"]]);  
//                    echo '=========';
//                    print_r($capacityArr);
                }
            }
            $chartBuckets = array(
            'text' => array('name' => strtoupper($name), 'desc' => substr($value['description'], 0, 24 ).'...'),
            'HTMLclass' => $class,
            'link' => array('href' => $linkType),   
            'children' => array()
            );
            $children = array();
            if(array_key_exists('children_rec', $value)){
              $children = $this->recursiveBucket($buckets, $value['children_rec'], $url, $bucketList);
            }
//            $children = $this->recursiveBucket($buckets, $value['children_rec'], $url);
            if ($children) {
                if (count($projectArray) > 0){
                    $children = array_merge($children, $projectArray);
                }
                if(count($capacityArr) > 0){
                    $children = array_merge($children, $capacityArr);
                }
                $chartBuckets['children'] = $children;
            }

            $chartData[] = $chartBuckets;
        }
        return $chartData;
    }

}
