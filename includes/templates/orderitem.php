<template>
  <template>
    <table style="width:100%">
      <tr>
	<td>
	</td>
      </tr>
    </table>
  </template>
  <div></div>
  <script>
    thisNode.addEventListener("changeProperty", function(propertyname){
      if (propertyname=="quantity" || propertyname=="price") {
	thisNode.parentNode.refreshView();
      }
    }, "reCaluculate");
    thisNode.showLabel=false;
    if (thisNode.parentNode.partnerNode.properties.status==0) { //editable only when order is not archived
      thisNode.editable=["quantity"];
    }
    thisNode.appendProperties(thisElement,"includes/templates/singlefield.php",function(){
      thisElement.lastElementChild.querySelector("span").parentElement.appendChild(document.createTextNode(" €"));
      thisElement.appendChild(DomMethods.intoColumns(getTpContent(thisElement.previousElementSibling).querySelector("table").cloneNode(true), thisElement, 0));
      thisElement.querySelector("table").rows[0].cells[0].style.width="2em";
      thisElement.querySelector("table").rows[0].cells[2].style.width="7em";
    });
    //We must remove now the 
  </script>
</template>