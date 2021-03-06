<template>
  <template>
    <div class="msgbox">
      <span></span>
      <script>
	var title=thisNode.getNextChild({"name":"chkt1add"}).getRelationship({name:"domelementsdata"}).getChild();
	title.writeProperty(thisElement);
	//adding the edition pencil
	var launcher = new Node();
	launcher.thisNode = title;
	launcher.editElement = thisElement;
	launcher.appendThis(thisElement.parentElement, "includes/templates/addbutedit.php");
      </script>
    </div>
    <div></div>
    <script>
      //First we must create a clone of mycart to not modify mycart.
      var ordercart=mycart.cloneNode();
      var cartboxitems=ordercart.getRelationship({name:"cartbox"}).children[0].getRelationship({name:"cartboxitem"});
      cartboxitems.refreshView(thisElement, "includes/templates/order.php");
    </script>
    <button class="btn"></button>
    <script>
      var buttonLabel=thisNode.getNextChild({"name":"chkt1next"}).getRelationship({name:"domelementsdata"}).getChild();
      buttonLabel.writeProperty(thisElement);
      var launcher = new Node();
      launcher.thisNode = buttonLabel;
      launcher.editElement = thisElement;
      launcher.createInput=true;
      launcher.appendThis(thisElement.parentElement, "includes/templates/addbutedit.php");
      
      //First we create a clone of mycart to not include modifications made at mycart.
      var ordercart=mycart.cloneNode();
      
      thisElement.onclick=function(){
	var insertuser=webuser.cloneNode();
	//Now we start to load rels so webuser clon: insertuser will be empty of any data
	insertuser.loadfromhttp({action: "load my relationships", user_id: webuser.properties.id}, function(){
	  insertuser.properties.id=webuser.properties.id;
	  insertuser.getRelationship({name:"orders"}).addChild(new NodeMale());
	  var myorder=insertuser.getRelationship({name:"orders"}).children[0];
	  myorder.loadfromhttp({action: "load my relationships", user_id: webuser.properties.id}, function(){
	    var myordercartitems=ordercart.getRelationship({name:"cartbox"}).children[0].getRelationship({name:"cartboxitem"}).children;
	    for (var i=0; i<myordercartitems.length; i++) {
	      var myorderitemdata=myordercartitems[i].cloneNode(0);
	      delete myorderitemdata.properties.id; //orderitem id is not from orderitem but from item
	      myorder.getRelationship({name:"orderitems"}).addChild(myorderitemdata);
	    }
	    //lets try to insert the order
	    //This request adds descendents
	    myorder.loadfromhttp({action: "add my tree", user_id: webuser.properties.id}, function(){
	      (new Node()).refreshView(document.getElementById("centralcontent"),"includes/templates/checkout2.php");
	      //We remove the items from the cart
	      mycart.getRelationship({name:"cartitem"}).children=[];
	      mycart.refreshcartbox();
	    });
	  });
	});
	return false;
      };
    </script>
  </template>
  <div style="text-align:center"></div>
  <script>
    var checkout=domelementsroot.getNextChild({name: "labels"}).getNextChild({"name":"middle"}).getNextChild({"name":"checkout"});
    checkout.refreshView(thisElement,thisElement.previousElementSibling);
  </script>
</template>