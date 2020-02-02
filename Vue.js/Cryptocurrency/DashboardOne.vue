<template>
  <div id="dashboard-2">
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light prim">
      <div class="logocontainer">
      </div>



      <a class="navbar-brand" href="#">transferpage</a>
      <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            &#9776;
         </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Terms</a>
          </li>

        </ul>
        <form class="form-inline mt-2 mt-md-0" _lpchecked="1">
          - logged in as -&nbsp;
          <button class="btn btn-outline-primary my-2 my-sm-0" variant="primary" type="button" @click="logout">logout</button>
        </form>
      </div>
    </nav>

    <div class="row">
      <div class="col-sm-12 col-md-8 col-xl-8">
        <div class="idb-block">
          <div class="idb-block-title">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-self-center">
                <h2>drag me araund</h2>

              </div>
            </div>
          </div>
          <div class="idb-full-block">
            <div class="text-center currencies">
              <div class="row container" style="margin: 15px 0 15px 0;" v-dragula="copyOne" service="my-third" drake="a" id='source'>
                <div class="col" v-for="(item, i) in items" :id="item" :key="i">
                  <i :class="'coin fa fa-'+item"></i> <!-- these items can dropped (copied) to '.list-group', but NOT to myCurrencies-->
                </div>
              </div>
            </div>
            <div class="align-self-center myWallet" style="margin-top: 15px;">
              <div class="container">
                <ul class="list-group"  v-dragula="copyTwo" service="my-third" drake="a" id='target'>
                  <li class="list-group-item" v-for="(item, i) in myWallee" :key="i">
                    <!-- these items can dropped (copied) to 'myCurrencies', but NOT to Currencies-->
                      <div class="row">
                        <div class="col-1" v-on:click="openModal">
                          <i :class="'SmCoin fa fa-'+item"></i>
                        </div>
                        <div class="col">{{item.toUpperCase()}}</div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                      </div>

                  </li>
                </ul>
              </div>
            </div>
            <div class="text-center coins">
              <div class="row"  style="margin-top: 15px">
                <div v-if="myCurrencies.length >= 0" class="col" v-for="(item, i) in myCurrencies" :id="item" :key="i">
                  <div class="drop btn btn-outline-light rounded-circle square-50 btn-circle">
                    <i :class="'fa fa-'+item"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="idb-block-title">
            <div class="d-flex justify-content-between">
              Footer
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4 col-xl-4">
        <div class="idb-block">
          <div class="idb-block-title">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-self-center">
                <h2>My Status</h2>
              </div>

            </div>
          </div>
          <div class="idb-block-content">

          </div>
        </div>
      </div>
    </div>

    <div class="row">


      <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="idb-block">
          <div class="idb-block-title">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-self-center">
                <h2>Actual charts</h2>
              </div>
            </div>
            <div class="seriescheck" style="text-align:center;">
           <input type="checkbox" id="BTC" value="BTC" v-model="checkedSeries" @click="serieschange($event)" true-value="yes"
  false-value="no">
         <label for="BRC">BRC</label>
         <input type="checkbox" id="ETH" value="ETH" v-model="checkedSeries" @click="serieschange($event)">
         <label for="ETH">ETH</label>
         <input type="checkbox" id="XRP" value="XRP" v-model="checkedSeries" @click="serieschange($event)">
         <label for="XRP">XRP</label>
         <input type="checkbox" id="NEO" value="NEO" v-model="checkedSeries" @click="serieschange($event)">
         <label for="NEO">NEO</label>
         <input type="checkbox" id="IOT" value="IOT" v-model="checkedSeries" @click="serieschange($event)">
         <label for="IOT">IOT</label>
         </div>
          </div>
          <div class="idb-block-content" id="container">
           <vue-highcharts :options="options" ref="highcharts"></vue-highcharts>
    <button @click="load">load</button>

          </div>
        </div>
      </div>
    </div>
    <b-modal class="modal fade" ref="transModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header info">
            <h5 class="modal-title" id="exampleModalLabel">transaction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </b-modal>

<button @click="openModal">open</button>

    <b-modal ref="myModalRef" hide-header hide-footer>

      <div class="viewjs-modal-pop">
                                   <i v-bind:class="'SmCoin fa fa-'+ this.targetIcon " style="color:white;"></i>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="hideModal">
              <span aria-hidden="true">&times;</span>
            </button>
     </div>


         <div class="modalmaterial">
            <div id='targeticonsdiv'>
            <ul id='targeticons' style="display:none;">
      <li v-for="(input, index) in inputs" :key="index">
       <div class="col-1" v-on:click="openModal">
                        </div>
       </li>
      </ul>
      </div>
      <div id="modalcheckboxes">
            <input type="radio" id="buy" :value="0" v-model="checked">
              <label for="buy">buy</label>
  <input type="radio" id="sell" :value="1" v-model="checked">
  <label for="sell">sell</label>
  <input type="radio" id="send" :value="2" v-model="checked">
  <label for="send">send</label>
  </div>

 <div class="popslider">
<b-form-slider v-model="rangeValue"  :min=0 :max=10000 :step=0.001 @change="change"></b-form-slider></div>
      <p>New price: {{ rangeValue }}</p>








            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="hideModal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
</div>
    </b-modal>

  </div>

</template>

<style scoped>
  #dashboard-2 {
    margin: 70px 15px 0 15px !important;
  }

  .coin {
    line-height: 53px;
    font-size: 48px;
    opacity: 0.35;
  }

.coin:hover{
  opacity: 1;
  cursor: pointer;
}
.list-group{
  min-height: 150px;
    border: 1px solid lightsalmon;
    border-radius: 5px;
}
.list-group-item:hover{
  background-color: rgba(87, 145, 160, 0.05);
}
.btn-outline-light{
  opacity: 0.35;
  border-color: #5791a0;
  cursor: pointer;
}
.btn-outline-light:hover{
  opacity: 1;
  border-color:#5791a0;
  cursor: pointer;
}
  .SmCoin {
    font-size: 20px;
  }

  .info{

    background-color: #5791a0;
  }
  .list-group[data-v-0eb65b6c] {
  border: 1px solid #5791a0 !important;
  }
  h3{
  color: white !important;
  }
  .slider.slider-horizontal {
    width: 460px !important;
}
</style>

<script>
  import VueHighcharts from 'vue2-highcharts'
  import moment from 'moment'

const asyncData = {
  name: 'Amount',
  marker: {
    symbol: 'square'
  },
  data: []
}
  export default {
    name: 'dashboard-1',
    components: {
      VueHighcharts
    },
    created () {
      this.$socket.emit('initgraph', 'kmb')
      var locale = window.navigator.userLanguage || window.navigator.language
      moment.locale(locale)
     // this.$socket.emit('initgraph', this.user)
      console.log('NAMED SERVICES: ready')

    let dragula = this.$dragula

    let myservice = dragula.$service;
    myservice.eventBus.$on('drop', this.handleDrop)
    this.chartoptions.push({ text: 'Default', value: 'default' })


    },
    mounted () {
      //this.load()
    },
    data: function () {
      return {
        modalShow: false,
        over: false,
        first: true,
        max: 60,
        items: ['angellist','bus','car','skyatlas','diamond'],
        myCurrencies: ['euro','inr','usd'],
        myWallee: ['bus'],
        myHTML: '',
        targetheading: '',
        targetIcon: '',
        copyOne: [],
        inputs: [],
        inputs2: [],
        chartoptions: [],
        checked: '',
         selected: 'default',
        copyTwo: [],
        checkedSeries: [],
         series: [],
          series1: [],           
          series2: [], 
          series3: [],
          series4: [],
          series5: [],
        rangeValue: 0,
        options: {
          chart: {
            type: 'line'
          },
          title: {
            text: ''
          },
          subtitle: {
            text: ''
          },
          xAxis: {
           title: {
              text: 'Time'
            },
              categories: []
          },
          yAxis: {
             title: {
              text: 'Amount'
            },
           labels: {
              formatter: function () {
                return  '$'+' '+this.value;
              }
            }
          },          
          tooltip: {
            crosshairs: true,
            shared: true
          },
          credits: {
            enabled: false
          },
          plotOptions: {
            spline: {
              marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
              }
            }
          },         
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    },
          names:  [],         
          dates: [],
          dates1: [],           
          dates2: [], 
          dates3: [],
          dates4: [],
          dates5: [],
          valuesarray: [],
          datesarray:  [],
          count: 0,
          seriescount: 0,
          initialcount: 0
        }
      }
    },
    methods: {
      admin () {
        //
      },
      logout () {
        //
      },
      toggleModal () {
        this.showModal = !this.showModal
      },
       showModal () {
      this.$refs.myModalRef.show()
    },
    hideModal () {
      this.$refs.myModalRef.hide()
     this.checked=0;

    },
      openModal () {
        // console.log(this.$refs.transModal())
        this.$refs.transModal.show()
      },
      closeModal () {
        this.showModal = false
      },
      handleDrop (dropdata) {
    if(dropdata.source.id=='source'){
    if(document.getElementById('targeticons').innerHTML!=""){
     document.getElementById('targeticons').innerHTML=""
     }
    /* if(document.getElementById('targetnodes').innerHTML!=""){
     document.getElementById('targetnodes').innerHTML=""
     }*/
        this.over = false

        var targetnodes = dropdata.container.childNodes;
        var targetlength = dropdata.container.childNodes.length;

         this.targetIcon = dropdata.el.id
         console.log(targetnodes);
        console.log("target"+this.targetIcon);
        this.targetheading = "Target Nodes";
         this.rangeValue = 1234.5;
        for(var i=0;i<targetlength;i++){
        if(targetnodes[i].id!=""){
         this.inputs.push({
        type: targetnodes[i].id,
        amount: 1234.5
      })
        }
        }


        this.showModal()
        }
        // alert(`You dropped with data: ${JSON.stringify(dropdata)}`)
      },
      handleListDrop (dropdata) {
        this.openModal()
        // alert(`You dropped with data: ${JSON.stringify(dropdata)}`)
      },
      onSubmit (evt) {
        evt.preventDefault()
      },
      showSuccess (file) {
        // console.log('A file was successfully uploaded')
      },
       change: function(value) {
            console.log(value);
          },
       serieschange : function(e) {
       
       var seriesLength = this.$refs.highcharts.chart.series.length;
       console.log("old"+ seriesLength)
       if(seriesLength>0){
                for(var i = seriesLength - 1; i > -1; i--)
                {

                       this.$refs.highcharts.chart.series[i].remove();
                }
                }
         var seriesLength2 = this.$refs.highcharts.chart.series.length;
       console.log("new"+ seriesLength2)
      if (e.target.checked) {
        console.log(e.target)
        this.checkedSeries.push(e.target.value)
      }
      else {
      console.log("removed"+e.target.value)
      this.checkedSeries.splice(this.checkedSeries.indexOf(e.target.value), 1);
      }
      this.load()
      },
     load(){
     console.log(asyncData.data)
     if(this.checkedSeries.length==0){
   
    
  
          this.series.push(this.series1)
          this.series.push(this.series2)
          this.series.push(this.series3)
          this.series.push(this.series4)
          this.series.push(this.series5) 
           var chunksize2 = this.series.length/5;
         var arrays = [], size2 = chunksize2;
         while (this.series.length > 0)
    arrays.push(this.series.splice(0, size2));
    
           var chart = this.$refs.highcharts.chart;
         chart.showLoading();
          document.getElementById("BTC").disabled = true;
          document.getElementById("ETH").disabled = true;
          document.getElementById("XRP").disabled = true;
          document.getElementById("NEO").disabled = true;
          document.getElementById("IOT").disabled = true;
          setTimeout(() => {
            // chart.addSeries(asyncData);             
           for(var k=0;k<arrays.length;k++){
           console.log(arrays[k])
			chart.addSeries({ 
			    id:    k,                       
				name: this.options.names[k],
				data: arrays[k][0]
			});
          }
          chart.hideLoading();
          document.getElementById("BTC").disabled = false;
          document.getElementById("ETH").disabled = false;
          document.getElementById("XRP").disabled = false;
          document.getElementById("NEO").disabled = false;
          document.getElementById("IOT").disabled = false;
               }, 2000)
              
                

               
                 
               }
               else{
    
        
         

this.series.push(this.series1)
          this.series.push(this.series2)
          this.series.push(this.series3)
          this.series.push(this.series4)
          this.series.push(this.series5) 
           var chunksize2 = this.series.length/5;
         var arrays = [], size2 = chunksize2;
         while (this.series.length > 0)
    arrays.push(this.series.splice(0, size2));
    
           var chart = this.$refs.highcharts.chart;
         chart.showLoading();
          document.getElementById("BTC").disabled = true;
          document.getElementById("ETH").disabled = true;
          document.getElementById("XRP").disabled = true;
          document.getElementById("NEO").disabled = true;
          document.getElementById("IOT").disabled = true;
          setTimeout(() => {
            // chart.addSeries(asyncData);             
           for(var k=0;k<arrays.length;k++){
       if(this.checkedSeries.includes(this.options.names[k])==true){       
       if(this.options.names[k]=="BTC"){
       var seriesid = 0;
       }
      else if(this.options.names[k]=="ETH"){
       var seriesid = 1;
       }
       else if(this.options.names[k]=="XRP"){
       var seriesid = 2;
       }
       else if(this.options.names[k]=="NEO"){
       var seriesid = 3;
       }
       else if(this.options.names[k]=="IOT"){
       var seriesid = 4;
       }
           console.log(arrays[k])
			chart.addSeries({   
			    id:    seriesid,        
				name: this.options.names[k],
				data: arrays[k][0]
			});
			}
          }
          chart.hideLoading();
          document.getElementById("BTC").disabled = false;
          document.getElementById("ETH").disabled = false;
          document.getElementById("XRP").disabled = false;
          document.getElementById("NEO").disabled = false;
          document.getElementById("IOT").disabled = false;
               }, 2000)
              

               } 
               
                 
            
       
           this.series.length = 0;
       }
   

    },
    sockets: {
      config (data) {
       //
      },
      initgraph (data) {
        console.log('initgraph')
        let curSeries = []
        curSeries[0] = []
        curSeries[1] = []
        curSeries[2] = []
        curSeries[3] = []
        curSeries[4] = []
        if (this.first) {
          this.first = false
          for (var i = 0; i < data.dates.length; i++) {
          this.chartoptions.push({ text: data.symbols[i], value: data.symbols[i] })
            curSeries[i]['name'] = data.symbols[i]
          curSeries[i]['dates'] = moment(data.dates[i]).format('LT')
           // curSeries[i]['dates'] = moment(data.dates[i]).format('HH:mm')
            curSeries[i]['values'] = data.values[i]
            
            console.log(i, curSeries)
            if(i==0){
            for(var b=0;b<curSeries.length;b++){
             if(b==0){
            this.series1.push(data.values[b])
            this.options.names.push(data.symbols[b])
            this.options.dates1.push(moment(data.dates[b]).format('LT'));
            }
           else if(b==1){
            this.series2.push(data.values[b])
            this.options.names.push(data.symbols[b])
            this.options.dates2.push(moment(data.dates[b]).format('LT'));
            }
           else if(b==2){
            this.series3.push(data.values[b])
            this.options.names.push(data.symbols[b])
            this.options.dates3.push(moment(data.dates[b]).format('LT'));
            }
            else if(b==3){
            this.series4.push(data.values[b])
            this.options.names.push(data.symbols[b])
            this.options.dates4.push(moment(data.dates[b]).format('LT'));
            }
             else if(b==4){
            this.series5.push(data.values[b])
            this.options.names.push(data.symbols[b])
            this.options.dates5.push(moment(data.dates[b]).format('LT'));
            }
            // this.series[i]['dates'].push(moment(data.dates[i]).format('LT'))
 
           }
           
            }
            }
          }
     this.options.initialcount++;
      },
      graph (data) {

    
           console.log("first"+this.series1.length)
   console.log("second"+this.series2.length)
    console.log("third"+this.series3.length)
     console.log("fourth"+this.series4.length)
      console.log("fifth"+this.series5.length)
      
      //console.log(asyncData);
         if (data.dates.length === 5) {
      console.log('next')        
        // console.log(data);

          
           console.log("seriescount"+this.seriescount)

           this.seriescount++;
        
            
           if(this.$refs.highcharts.chart.series.length>0){
            
           
           console.log("intial"+this.options.initialcount)
           if(this.options.initialcount==1){
           if(this.checkedSeries.length==0){
        //     console.log(asyncData)
                this.$refs.highcharts.chart.series[0].addPoint([moment(data.dates[0]).format('LT'),data.values[0]]);
           this.$refs.highcharts.chart.series[1].addPoint([moment(data.dates[1]).format('LT'),data.values[1]]);
           this.$refs.highcharts.chart.series[2].addPoint([moment(data.dates[2]).format('LT'),data.values[2]]);
           this.$refs.highcharts.chart.series[3].addPoint([moment(data.dates[3]).format('LT'),data.values[3]]);
           this.$refs.highcharts.chart.series[4].addPoint([moment(data.dates[4]).format('LT'),data.values[4]]);
          
          

           }
           else{
          
                var id1 = 0;
          var id2 = 1;
          var id3 = 2;
          var id4 = 3;
          var id5 = 4;
          console.log(this.$refs.highcharts.chart) 
          console.log(this.seriescount)
          if ( this.$refs.highcharts.chart.get( id1 ) ) {
           var currentseries1 = this.$refs.highcharts.chart.get(id1)
             currentseries1.data[0].remove(false, false);
         currentseries1.addPoint([moment(data.dates[0]).format('LT'),data.values[0]]);
          
           }
           if(this.$refs.highcharts.chart.get( id2 )){
           
           var currentseries2 = this.$refs.highcharts.chart.get(id2)
        console.log("first"+data.dates[1]);
        currentseries2.data[0].remove(false, false);
         currentseries2.addPoint([moment(data.dates[1]).format('LT'),data.values[1]]);
         
           }
         if(this.$refs.highcharts.chart.get( id3 )){
           
           var currentseries3 = this.$refs.highcharts.chart.get(id3)
     console.log("second"+data.dates[2]);
     currentseries3.data[0].remove(false, false);
          currentseries3.addPoint([moment(data.dates[2]).format('LT'),data.values[2]]);
           
           }
           if(this.$refs.highcharts.chart.get( id4 )){
           
           var currentseries4 = this.$refs.highcharts.chart.get(id4)
     console.log("third"+data.dates[3]);
     currentseries4.data[0].remove(false, false);
          currentseries4.addPoint([moment(data.dates[3]).format('LT'),data.values[3]]);
         
           }
           if(this.$refs.highcharts.chart.get( id5 )){
           
           var currentseries5 = this.$refs.highcharts.chart.get(id5)
          console.log("fourth"+currentseries5);
          currentseries5.data[0].remove(false, false);
          currentseries5.addPoint([moment(data.dates[4]).format('LT'),data.values[4]]);
       
           }
           
            
         this.series1.push(data.values[0])
          this.series2.push(data.values[1])
          this.series3.push(data.values[2])
          this.series4.push(data.values[3])
          this.series5.push(data.values[4]) 
      
               var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};

var myArray = this.options.xAxis.categories
   var needle = moment(data.dates[4]).format('LT')
    var index = contains.call(myArray, needle); // true
       if(index==false){   
           this.options.xAxis.categories.push(moment(data.dates[4]).format('LT'))
           }
           console.log("index"+index);
 
         
  console.log("latestdates"+this.options.xAxis.categories)
            
           }
           }
        else{
        this.options.initialcount=1;
        console.log('done'+this.options.initialcount)
        }
           }
       
           else{
            if(this.options.initialcount==1){
            console.log("start");
           for (var i = 0; i < data.dates.length; i++) {
             
            if(i==0){
            this.series1.push(data.values[i])
            this.options.dates1.push(moment(data.dates[i]).format('LT'));
            }
           else if(i==1){
            this.series2.push(data.values[i])
            this.options.dates2.push(moment(data.dates[i]).format('LT'));
            }
           else if(i==2){
            this.series3.push(data.values[i])
            this.options.dates3.push(moment(data.dates[i]).format('LT'));
            }
            else if(i==3){
            this.series4.push(data.values[i])
            this.options.dates4.push(moment(data.dates[i]).format('LT'));
            }
             else if(i==4){
            this.series5.push(data.values[i])
            this.options.dates5.push(moment(data.dates[i]).format('LT'));
             this.options.dates.push(moment(data.dates[i]).format('LT'))
      
            this.options.xAxis.categories.push(moment(data.dates[4]).format('LT'))
            }
            // this.series[i]['dates'].push(moment(data.dates[i]).format('LT'))
                   
            console.log("x"+this.options.xAxis.categories);
           
           
           }
           }
           }
           }
            

      }
    }
  }
</script>
<style>
.slider.slider-horizontal {
    width: 460px !important;
}
.modalmaterial {
    padding: 15px;
}
.modal-body{padding:0;}
.viewjs-modal-pop{ background-color: #5791a0;padding:10px 15px;}
.popslider {
    position: relative;
}
@media screen and (max-width:520px){
.slider.slider-horizontal {
    width: 90%;
    position: static;
}

}

</style>
