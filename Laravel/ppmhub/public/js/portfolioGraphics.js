/* 
 * Portfolio capacity planning 
 * portfolio graphics
 * 
 */


$(document).ready(function () {
$('.category').attr('disabled', 'disabled');
 $('.portfolioStructure').change(function () {
    renderPortfolioStructure($(this).val(), 0);
    $('.category').removeAttr('disabled');
    $('.category').val(0);
  });
 $('.category').change(function () {
   renderPortfolioStructure($('.portfolioStructure').val(), $(this).val());
  });
  function renderPortfolioStructure(id, filter) {
    $.ajax({
      url: "/admin/portfolioGraphics/" + id + '?filter='+ filter,
      method: "GET",
      dataType: "JSON "
    }).done(function (response) {
      console.log(response);
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
          type: 'step',
          style: {
                'stroke': '#000000',
                'arrow-end': 'block-wide-long'
            }
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

