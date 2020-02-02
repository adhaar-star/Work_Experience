<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\quantitative_risk_analysis;
use App\qualitative_risk_analysis;
use Illuminate\Support\Facades\Auth;

class riskanalysis extends Model
{
	protected $table = "qualitative_risk_analysis";
        
        public $timestamp = true;
		
        
    public static function riskChart($projectId){
        $riskQualitative = qualitative_risk_analysis::Where('project_id', $projectId)->Where('company_id', Auth::User()->company_id)->get();
        $riskChart = array();    
        $riskChart[0]['y'] = $riskChart[1]['y'] = $riskChart[2]['y'] = 0;
        $riskChart[0]['indexLabel'] = $riskChart[0]['legendText'] ='High';
        $riskChart[0]['color'] = '#ff0000';
        
        $riskChart[1]['indexLabel'] = $riskChart[1]['legendText'] = 'Medium';
        $riskChart[1]['color'] = '#ffc003';
        
        $riskChart[2]['indexLabel'] = $riskChart[2]['legendText'] = 'Low';
        $riskChart[2]['color'] = '#05b050';
        
        foreach($riskQualitative as $key => $rqual){
            if($rqual->risk_score >= 1 && $rqual->risk_score <= 3) {
                $riskChart[2]['y']++; //green
            }
            else if($rqual->risk_score >= 4 && $rqual->risk_score <= 12) {
                $riskChart[1]['y']++; //yellow
            }
            else if($rqual->risk_score >= 15 && $rqual->risk_score <= 25){
                $riskChart[0]['y']++; //red
            }
        }

        $riskQuantitative = quantitative_risk_analysis::Where('project_id', $projectId)->Where('company_id', Auth::User()->company_id)->get();

        foreach($riskQuantitative as $key => $rquant){
            if($rquant->quan_risk_score <= 2){
                $riskChart[2]['y']++; //green
            }
            else if($rquant->quan_risk_score == 3){
                $riskChart[1]['y']++;   //yellow
            }
            else if($rquant->quan_risk_score >= 4){
                $riskChart[0]['y']++; //red
            }
        }
        sort($riskChart);
        return $riskChart;
    }
    
    /**
     * RAG table risk data
     * @param type $data
     * @param type $projectId
     * @return type
     */
    public static function RAGRisk($data, $projectId){
        $riskQualitative = qualitative_risk_analysis::Where('project_id', $projectId)->Where('company_id', Auth::User()->company_id)->get();
        $riskQuantitative = quantitative_risk_analysis::Where('project_id', $projectId)->Where('company_id', Auth::User()->company_id)->get();
        
        foreach($riskQualitative as $key => $rqual){
            if($rqual->risk_score >= 1 && $rqual->risk_score <= 3) {
                $data['green']++; //green
            }
            else if($rqual->risk_score >= 4 && $rqual->risk_score <= 12) {
                $data['yellow']++; //yellow
            }
            else if($rqual->risk_score >= 15 && $rqual->risk_score <= 25){
                $data['red']++; //red
            }
        }
        foreach($riskQuantitative as $key => $rquant){
            if($rquant->quan_risk_score <= 2){
                $data['green']++; //green
            }
            else if($rquant->quan_risk_score == 3){
                $data['yellow']++; //yellow
            }
            else if($rquant->quan_risk_score >= 4){
                $data['red']++; //red
            }
        }
        return $data;
    }
    
    /**
     * Return traffic light for project
     * @param type $risk
     * @return string
     */
    public static function riskLight($risk){
        if($risk['red'] >= $risk['yellow'] && $risk['red'] >= $risk['green']){
            $riskLight = 'red';
        } else if($risk['yellow'] >= $risk['red'] && $risk['yellow'] >= $risk['green']){
            $riskLight = 'yellow';
        } else if($risk['green'] >= $risk['yellow'] && $risk['green'] >= $risk['red']){
            $riskLight = 'green';
        }
        return $riskLight;
    }
}
