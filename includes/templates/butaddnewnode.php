<template id="butaddnewnodetp">
  <a href="" class="butadd">
    <img src="includes/css/images/plus.png"/>
  </a>
  <script>
    //normalize
    var launcher=thisNode;
    var thisNode=thisNode.myNode;
    thisElement.onclick=function() {
      var myresult=new NodeMale();
      myresult.parentNode=new NodeFemale();
      myresult.parentNode.loadasc(thisNode.parentNode,1);
      if (launcher.sort_order) myresult.sort_order=launcher.sort_order;
      myresult.loadfromhttp({action:"add myself", user_id: webuser.properties.id}, function(){
	var thisParent=thisNode.parentNode;
	if (!thisNode.properties.id) thisParent.children=[]; //Adding first child
	thisParent.addChild(myresult);
	thisParent.refreshChildrenView();
	thisParent.dispatchEvent("addNewNode", [myresult]);
      });
      return false;
    }
  </script>
</template>