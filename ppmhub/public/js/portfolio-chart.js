$(document).ready(function () {
   
 $('.portfolioStructure').change(function () {
    renderPortfolioStructure($(this).val());
  });
  function renderPortfolioStructure(id) {
    $.ajax({
      url: "/admin/getportfolio-structure/" + id,
      method: "GET",
      dataType: "JSON "
    }).done(function (response) {
      treeChart(response);
      console.log('response', response);
    });
  }
  function treeChart(data) {
    simple_chart_config = {
      chart: {
        container: "#tree-chart",
        nodeAlign: "BOTTOM",
        animateOnInit: true,
        connectors: {
          type: 'step'
        },
        node: {
          HTMLclass: 'nodeExample1',
          collapsable: false
        },
        animation: {
            nodeAnimation: "easeOutBounce",
            nodeSpeed: 700,
            connectorsAnimation: "bounce",
            connectorsSpeed: 700
          }
      },
      nodeStructure: data,
//      nodeStructure: {
//        text: {name: "Portfolio"}, HTMLclass: 'light-red',
//        children: [
//          {
//            text: {name: "Bucket1"}, HTMLclass: 'light-gray',
//            children: [
//              {
//                text: {name: "Bucket1"}, HTMLclass: 'light-gray',
//                children: [
//                  {
//                    text: {name: "Bucket12"}, HTMLclass: 'blue ',
//                  },
//                  {
//                    text: {name: "Bucket13"}, HTMLclass: 'blue ',
//                  },
//                  {
//                    text: {name: "Bucket14"}, HTMLclass: 'blue ',
//                  },
//                  {
//                    text: {name: "Bucket15"}, HTMLclass: 'blue ',
//                  },
//                  {
//                    text: {name: "Bucket16"}, HTMLclass: 'blue ',
//                  },
//                ]
//              },
//              {
//                text: {name: "Bucket2", }, HTMLclass: 'light-gray',
//                children: [
//                  {
//                    text: {name: "Project"}, HTMLclass: 'blue ',
//                  }
//                ]
//              },
//              {
//                text: {name: "Bucket3"}, HTMLclass: 'light-gray',
//              },
//              {
//                text: {name: "Bucket4", }, HTMLclass: 'light-gray',
//              }
//            ]
//          }
//        ]
//      }
    };
    new Treant(simple_chart_config);
  }
});

