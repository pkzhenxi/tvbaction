/*
 level ---级别
 vid --- 记录ID
 dir --- 图片目录路径
 type --- 类型(数据 or 新闻)
 url ---- ajax请求url
 inputid --- 要赋值的隐藏文本框ID
 */
function starView(level,vid,dir,type,url,inputid){
    var i,j,htmlStr;
    var htmlStr="";
    if (level==0){level=0}
    if (level>0){htmlStr += "<img src='"+dir+"/images/starno.gif' border='0' style='cursor:pointer;margin-left:2px;margin-bottom:5px;' title='取消推荐'  onclick='commendVideo("+vid+","+0+","+type+",\""+dir+"\",\""+inputid+"\",\""+url+"\")'/>"}
    for (i=1;i<=level;i++){
        htmlStr+= "<img src='"+dir+"/images/star0.gif' border='0' style='cursor:pointer;margin-left:2px;margin-bottom:5px;' onclick='commendVideo("+vid+","+i+","+type+",\""+dir+"\",\""+inputid+"\",\""+url+"\")' title='推荐为"+i+"星级' id='star"+vid+"_"+i+"' />"
    }
    for(j=level+1;j<=5;j++){
        htmlStr+= "<img src='"+dir+"/images/star1.gif' border='0' style='cursor:pointer;margin-left:2px;margin-bottom:5px;' onclick='commendVideo("+vid+","+j+","+type+",\""+dir+"\",\""+inputid+"\",\""+url+"\")' title='推荐为"+j+"星级' id='star"+vid+"_"+j+"' />"
    }
    $("#star"+vid).html(htmlStr);
}

function commendVideo(vid,level,type,dir,inputid,url){
   if(type == 0){
      starView(level,vid,dir,type,url,inputid);
      $("#"+inputid).val(level);
   }else if(type == 1){
      $.ajax({
           url : url,
           type : 'GET',
           data : 'vid=' + vid + '&level='+level,
           dataType : 'text',
           async : true,
           success : function(data){
              if(data == 'true'){
                   starView(level,vid,dir,type,url,inputid);
              }
           }
       });

   }
}