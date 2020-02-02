$(document).ready(function () {
   
 $('.projectStructure').change(function () {
    renderProjectStructure($(this).val());
  });
  function renderProjectStructure(id) {
    if(id != null && id != undefined && id != '') {
      $.ajax({
        url: "/admin/getproject-structure/" + id,
        method: "GET",
        dataType: "JSON "
      }).done(function (response) {
        treeChart(response);
        console.log('response', response);
      });
    }
  }
  function treeChart(data) {
    simple_chart_config = {
      chart: {
        container: "#tree-chart",
        nodeAlign: "TOP",
        rootOrientation : 'WEST',
        animateOnInit: true,
        connectors: {
          type: 'step',
          style: {
						'stroke': '#9933ff',
						'arrow-end': 'block-wide-long',
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
    };
    new Treant(simple_chart_config);
  }
});

