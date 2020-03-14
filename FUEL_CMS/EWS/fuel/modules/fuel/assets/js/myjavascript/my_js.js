
var num=[];
$('#button1').click(function(){
$.ajax({
        url: "",
        context: document.body,
        success: function(s,x){

            $('html[manifest=saveappoffline.appcache]').attr('content', '');
                $(this).html(s);
}

});
var x=document.getElementById("field5").value;
var j=" | ";
var s="";


num.push(x);
 for(var i=0;i<num.length;i++)
 {
 
 
 s=num;

 }
function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}
var unique = num.filter( onlyUnique ); 

document.getElementById("field8").value=unique;
 
 });
