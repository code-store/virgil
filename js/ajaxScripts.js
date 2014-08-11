/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function getXMLHttp()
{
  var xmlHttp

  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}





function select_product(productID)
{
  var xmlHttp = getXMLHttp();
 
 document.getElementById('selectDiv').innerHTML = "LOADING... ";
 
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
      HandleResponse(xmlHttp.responseText);
    }
  }

  xmlHttp.open("GET", "select_product.php?productID="+productID, true);
  xmlHttp.send(null);
}



function HandleResponse(response)
{
  document.getElementById('selectDiv').innerHTML = response;
}

//------------------------------------------------------------------//


function select_product_group(productID)
{
  var xmlHttp = getXMLHttp();
 
 document.getElementById('selectDiv_group').innerHTML = "LOADING... ";
 
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
      HandleResponse_group(xmlHttp.responseText);
    }
  }

  xmlHttp.open("GET", "select_product.php?productID="+productID, true);
  xmlHttp.send(null);
}



function HandleResponse_group(response)
{
  document.getElementById('selectDiv_group').innerHTML = response;
}

//------------------------------------------------------------------//




function HandleResponse_slaveDiv(response)
{
  document.getElementById('slaveDiv').innerHTML = response;
}


//------------------------------------------------------------------------------

function edit_product_form(productID)
{
  var xmlHttp = getXMLHttp();
 
 document.getElementById('slaveDiv').innerHTML = "LOADING...";
 
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
      HandleResponse_slaveDiv(xmlHttp.responseText);
    }
  }

  xmlHttp.open("GET", "edit_product_form.php?productID="+productID, true);
  xmlHttp.send(null);

}



function HandleResponse_slaveDiv(response)
{
  document.getElementById('slaveDiv').innerHTML = response;
}





//---------------------------------------------------------------------------------


function insert_product(lang, prodName, prodPrice, description, image)
{
  
  //alert(image);
  //alert(description);
  
  
  if (prodName == "" || prodPrice=="" || description=="" || image=="") {
																		if (lang == 'locale/en_EN.csv') alert("Field remained blank or image upload was unsuccesfull!!");
																		if (lang == 'locale/de_DE.csv') alert("Feld blieb leer oder Bild-Upload ist fehlgeschlagen!");
																		if (lang == 'locale/nl_NL.csv') alert("Veld bleef leeg of het uploaden van afbeeldingen is mislukt!");
																		}
  
	else {
			var xmlHttp = getXMLHttp();
 
				 document.getElementById('slaveDiv').innerHTML = "LOADING... Please wait!";
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_slaveDiv(xmlHttp.responseText);
					}
				  }

				  var description2 = addslashes(description);
				  xmlHttp.open("GET", "insert_product.php?productName="+prodName+"&productPrice="+prodPrice+"&image="+image+"&description="+description2, true);
				  xmlHttp.send(null);
			}
  
}


function addslashes(str) {

str=str.replace(/#/g,'~');
str=str.replace(/&nbsp;/g,'<br/>');
//alert(str);
return str;
}


function update_product(lang, product_id, product_name, product_price, product_description)
{
  
  if (product_name == "" || product_price=="" || product_description=="") {
																			if (lang == 'locale/en_EN.csv') alert("Field remained blank or image upload was unsuccesfull!!");
																			if (lang == 'locale/de_DE.csv') alert("Feld blieb leer oder Bild-Upload ist fehlgeschlagen!");
																			if (lang == 'locale/nl_NL.csv') alert("Veld bleef leeg of het uploaden van afbeeldingen is mislukt!");
																			}
  
  
  //alert(product_id+" "+product_name+" "+product_price+" "+product_description);
	else {
			var xmlHttp = getXMLHttp();
 
				 document.getElementById('slaveDiv').innerHTML = "LOADING... Please wait!";
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_slaveDiv(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "update_product.php?product_id="+product_id+"&product_name="+product_name+"&product_price="+product_price+"&product_description="+product_description, true);
				  xmlHttp.send(null);
			}
			
	//location.reload(true);
}


function delete_product(lang, product_id)
{

	var text = '';
	if (lang == 'locale/en_EN.csv') alert("Are you sure? \n (The removal of this product affects all the group deals associated with it!!)");
	if (lang == 'locale/de_DE.csv') alert("Sind Sie sicher? \n (Die Entfernung dieses Produkt wirkt sich auf alle besch�ftigt sich die Unternehmensgruppe mit ihr verbundenen!)");
	if (lang == 'locale/nl_NL.csv') alert("Weet je het zeker? \n (Het verwijderen van dit product invloed op alle van de groep gaat die ermee verbonden zijn!)");
  
  if (confirm(text))
	{
	
  
  
			var xmlHttp = getXMLHttp();
 
				 document.getElementById('slaveDiv').innerHTML = "LOADING...";
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_slaveDiv(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "delete_product.php?product_id="+product_id, true);
				  xmlHttp.send(null);
			
	}
}


//---------------------------------------------------------------------------------


function insert_deal(product_id, start_date, end_date, promotion_value, minim_amount)
{
  
  if (product_id == "")  alert("There are no products selected yet!!");
  
  else {if (start_date=="0000-00-00") alert("Deal's start date was not set!");
  
	else {if (end_date=="0000-00-00") alert("Deal's end date was not set!");

		else {if (promotion_value=="Ex: 1.5") alert("Deal's promotion value not set!"); 

			else {if (minim_amount=="Ex: 10") alert("Deal's minim number of products not set!");

					else {
							
						var xmlHttp = getXMLHttp();
			 
							 document.getElementById('dealDiv').innerHTML = "LOADING... Please wait!";
							 
							  xmlHttp.onreadystatechange = function()
							  {
								if(xmlHttp.readyState == 4)
								{
								  HandleResponse_dealDiv(xmlHttp.responseText);
								}
							  }

							  xmlHttp.open("GET", "insert_deal.php?product_id="+product_id+"&start_date="+start_date+"&end_date="+end_date+"&promotion_value="+promotion_value+"&minim_amount="+minim_amount, true);
							  xmlHttp.send(null);
							}
				}
			}
		}
	}
 
}


function delete_deal(deal_id)
{
  
  if (confirm("Are you sure?"))
	{
  
			var xmlHttp = getXMLHttp();
 
				 document.getElementById('dealDiv').innerHTML = "LOADING...";
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_dealDiv(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "delete_deal.php?deal_id="+deal_id, true);
				  xmlHttp.send(null);
			
	}
	//location.reload(true);	
}



function HandleResponse_dealDiv(response)
{
  document.getElementById('dealDiv').innerHTML = response;
}



//--------------------------------------------------------------------------------------------//

function insert_groupdeal(product_id, start_date, end_date, discount1, discount2, discount3)
{
  
  if (product_id == "")  alert("There are no products selected yet!!");
  
  else {if (start_date=="0000-00-00") alert("Deal's start date was not set!");
  
	else {if (end_date=="0000-00-00") alert("Deal's end date was not set!");

		else {if (discount1=="") alert("Discount1 not set!"); 

			else {if (discount2=="") alert("Discount2 not set!");

					else {if (discount3=="") alert("Discount3 not set!");

						else {
								var xmlHttp = getXMLHttp();
					 
									 document.getElementById('dealDiv').innerHTML = "LOADING... Please wait!";
									 
									  xmlHttp.onreadystatechange = function()
									  {
										if(xmlHttp.readyState == 4)
										{
										  HandleResponse_dealDiv(xmlHttp.responseText);
										}
									  }

									  xmlHttp.open("GET", "insert_groupdeal.php?product_id="+product_id+"&start_date="+start_date+"&end_date="+end_date+"&discount1="+discount1+"&discount2="+discount2+"&discount3="+discount3, true);
									  xmlHttp.send(null);
								}
					}
				}
			}
		}
	}
 
}



function delete_groupdeal(deal_id)
{
  
  if (confirm("Are you sure?"))
	{
  
			var xmlHttp = getXMLHttp();
 
				 document.getElementById('dealDiv').innerHTML = "LOADING...";
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_dealDiv(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "delete_groupdeal.php?deal_id="+deal_id, true);
				  xmlHttp.send(null);
			
	}
	//location.reload(true);	
}



function HandleResponse_dealDiv(response)
{
  document.getElementById('dealDiv').innerHTML = response;
}




//---------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------//

function generate_order_form(name, id, price, discount)
{
			var xmlHttp = getXMLHttp();
 
				 document.getElementById('orderDiv').innerHTML = "LOADING...";
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_orderDiv(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "../../place_order_form.php?name="+name+"&id="+id+"&price="+price+"&discount="+discount+"&random=" + Math.random(), true);
				  xmlHttp.send(null);
		
}

function launch_order(name, telephone, email, skype, company, city, district, address, country, productName, productID, productPrice, discount, productQuantity)
{
	
if (productQuantity == "")  alert("'Product quantity' field left blank!");

else
	{
	
if (name == "")  alert("'NAME' field left blank!");
  
  else {if (telephone=="") alert("'TELEPHONE' field left blank!");
  
		else {if (email=="") alert("'E-MAIL' field left blank!");

			else {if (city=="") alert("'CITY' field left blank!"); 

				else {if (district=="") alert("'DISTRICT/COUNTY' field left blank!");
						
					else {if (address=="") alert("'ADDRESS' field left blank!"); 

						else {if (country=="---") alert("'COUNTRY' field left unselected!");
						
							else {

									var xmlHttp = getXMLHttp();
						 
										 document.getElementById('orderDiv').innerHTML = "LOADING...";
										 
										  xmlHttp.onreadystatechange = function()
										  {
											if(xmlHttp.readyState == 4)
											{
											  HandleResponse_orderDiv(xmlHttp.responseText);
											}
										  }

										  xmlHttp.open("GET", "../../place_order.php?name="+name+"&telephone="+telephone+"&email="+email+"&skype="+skype+"&company="+company+"&city="+city+"&district="+district+"&address="+address+"&country="+country+"&productName="+productName+"&productID="+productID+"&productPrice="+productPrice+"&productQuantity="+productQuantity+"&discount="+discount+"&random=" + Math.random(), true);
										  xmlHttp.send(null);
								}
							}
						}
					}
				}
	 
			}
		}
	}
	
	update_ALL();
}



function HandleResponse_orderDiv(response)
{
  document.getElementById('orderDiv').innerHTML = response;
}

//-------------------------------------------------------------------------//

function updateIframe()
{
	document.getElementById('myIframe').contentDocument.location.reload(true);
	}

function showPreview(url)
{
	document.getElementById('myIframe').src = url;
	}

function showEditPage(url)
{
	document.getElementById('myIframe').src = url;
	}	
	
	
function update_ALL(where)
{
	timeoutPeriod = 2000;
	//setTimeout("location.reload(true);",timeoutPeriod);
	setTimeout(function () {
	window.location.href = "admin.php"+where;
	}, timeoutPeriod);
	}	

//------------------------------------------------------------------------//


function change_deal(product_id, product_name, product_price, deal_start, deal_end, promotion_value, min_amount, desc, image)

{

	var xmlHttp = getXMLHttp();
 
				 document.getElementById('showDiv').innerHTML = "LOADING...";
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_showDiv(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "load_deal.php?product_id="+product_id+"&product_name="+product_name+"&product_price="+product_price+"&deal_start="+deal_start+"&deal_end="+deal_end+"&promotion_value="+promotion_value+"&min_amount="+min_amount+"&desc="+desc+"&image="+image+"&random=" + Math.random(), true);
				  xmlHttp.send(null);
}	



function HandleResponse_showDiv(response)
{
  document.getElementById('showDiv').innerHTML = response;
}

//------------------------------------------------------------------------//


function change_groupdeal(product_id, product_name, product_price, deal_start, deal_end, discount1, discount2, discount3, desc, image)

{

	var xmlHttp = getXMLHttp();
 
				 document.getElementById('showDiv').innerHTML = "LOADING...";
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_showDiv(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "load_groupdeal.php?product_id="+product_id+"&product_name="+product_name+"&product_price="+product_price+"&deal_start="+deal_start+"&deal_end="+deal_end+"&discount1="+discount1+"&discount2="+discount2+"&discount3="+discount3+"&desc="+desc+"&image="+image+"&random=" + Math.random(), true);
				  xmlHttp.send(null);
}	



function HandleResponse_showDiv(response)
{
  document.getElementById('showDiv').innerHTML = response;
}




function changeLanguage(lang)
{

	var loc = location.href;
	loc = loc.substring(0,loc.indexOf("#"));
	window.location.href = loc+"?lang="+lang; 

}


//----------------------------------------------------------------------------------------------------------//
//-----------------------saveToFile(fileSelector.value, elm1.value)-----------------------------------------//


function changeFile(file)
{

	/*alert('Press The Load Content Button!');*/
	var xmlHttp = getXMLHttp();
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_file_elm1(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "getPageText.php?file="+file, true);
				  xmlHttp.send(null);		  
}	

	function HandleResponse_file_elm1(response)
	{
		document.getElementById('elm1').value = response;
	}

	
	
function changeFile_footer(file)
{

	/*alert('Press The Load Content Button!');*/
	var xmlHttp = getXMLHttp();
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_file_foot(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "getPageText.php?file="+file+"&dir=CMS_footer", true);
				  xmlHttp.send(null);		  
}	

	function HandleResponse_file_foot(response)
	{
		document.getElementById('elm_footer').value = response;
	}	

	
function changeFile_website(file)
{
	var xmlHttp = getXMLHttp();
				 
	  xmlHttp.onreadystatechange = function()
	  {
		if(xmlHttp.readyState == 4)
		{
		  HandleResponse_file_elm2(xmlHttp.responseText, file);
		}
	  }

	  xmlHttp.open("GET", "getPageText.php?file="+file, true);
	  xmlHttp.send(null);		  
}	



	function strpos (haystack, needle, offset) {
	  var i = (haystack + '').indexOf(needle, (offset || 0));
	  return i === -1 ? false : i;
	}


	function HandleResponse_file_elm2(response, file)
	{
		var pos1 = strpos(response, " [0] => ");
		var pos2 = strpos(response, " [1] => ");
		var pos3 = strpos(response, " [2] => ");
		var pos4 = strpos(response, " [3] => ");
		var pos5 = strpos(response, " [4] => ");
		var pos6 = strpos(response, " [5] => ");
		var pos7 = strpos(response, " [6] => ");
		var pos8 = strpos(response, " [7] => ");
		var pos9 = strpos(response, ")", pos8);
		
		var text = response.substr(pos1 + 8, pos2 - pos1 - 11);
		var meta_t = response.substr(pos2 + 8, pos3 - pos2 - 11);
		var meta_d = response.substr(pos3 + 8, pos4 - pos3 - 11);
		var meta_k = response.substr(pos4 + 8, pos5 - pos4 - 11);
		var ishome = response.substr(pos5 + 8, pos6 - pos5 - 11);
		var urlinput = response.substr(pos6 + 8, pos7 - pos6 - 11);
		var template = response.substr(pos7 + 8, pos8 - pos7 - 11);
		var language = response.substr(pos8 + 8, pos9 - pos8 - 8);
				
		document.getElementById('elm2').value = text;
		document.getElementById('new_title').value = file;
		document.getElementById('meta_t').value = meta_t;
		document.getElementById('meta_d').value = meta_d;
		document.getElementById('meta_k').value = meta_k;
		if (ishome == 1){
			document.getElementById('ishome').checked = true;
		}
		else{
			document.getElementById('ishome').checked = false;
		}
		document.getElementById('urlinput').value = urlinput;
		document.getElementById('templateSelector_input').value = template;
		
		//alert(language);
		
		 var sel = document.getElementById('pageLang');
			for(var i, j = 0; i = sel.options[j]; j++) {
				
							
				if(trim(i.value) == trim(language)) {
					
					//alert(sel.options[j].value);
				
					sel.selectedIndex = j;
					sel.value = j;
					sel[j].selected = true;
					sel.options[j].selected = true;
					
					//alert(language);
					//alert(sel.options[j].selected);
					
					break;
				}
			}
			
		//sel.options[sel.options.selectedIndex].selected = true;	
	}	
	
function trim(str) {
    return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}
	
	
function changeBanner(file)
{
	var xmlHttp = getXMLHttp();
				 
	  xmlHttp.onreadystatechange = function()
	  {
		if(xmlHttp.readyState == 4)
		{
		  HandleResponse_file_elm3(xmlHttp.responseText);
		}
	  }

	  xmlHttp.open("GET", "getBannerText.php?file="+file, true);
	  xmlHttp.send(null);		  
}	



	function HandleResponse_file_elm3(response)
	{
		var pos1 = strpos(response, " [0] => ");
		var pos2 = strpos(response, " [1] => ");
		var pos3 = strpos(response, ")", pos2);
	
		var content = response.substr(pos1 + 8, pos2 - pos1 - 11);
		var language = response.substr(pos2 + 8, pos3 - pos2 - 8);
	
		document.getElementById('elm3').value = content;
		
		var sel = document.getElementById('bannerLang');
			for(var i, j = 0; i = sel.options[j]; j++) {
				
				if(trim(i.value) == trim(language)) {
									
					sel.selectedIndex = j;
					sel.value = j;
					sel[j].selected = true;
					sel.options[j].selected = true;
					
					break;
				}
			}
	}		
	
	
	
	
	
	

function change_category(productID, categoryID)
		{
		
		alert('here');
		var xmlHttp = getXMLHttp();
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  
					}
				  }

			xmlHttp.open("GET", "changeProdCategory.php?productID="+productID+"&categoryID="+categoryID, true);
			xmlHttp.send(null);	
		}
		
		

function load_products(categID)
{

	var xmlHttp = getXMLHttp();
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_prods(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "../../getProductsByCateg.php?categID="+categID, true);
				  xmlHttp.send(null);		  
}	


function load_product_webshop(prodID)
{

	var xmlHttp = getXMLHttp();
				 
				  xmlHttp.onreadystatechange = function()
				  {
					if(xmlHttp.readyState == 4)
					{
					  HandleResponse_prods(xmlHttp.responseText);
					}
				  }

				  xmlHttp.open("GET", "../../getSingleProduct.php?prodID="+prodID, true);
				  xmlHttp.send(null);		  
}



	function HandleResponse_prods(response)
	{
		document.getElementById('productsGrid').innerHTML = response;
	}	
			
	
	
	function fillLabel(val, discount)
	{
		if (discount.indexOf("_") != -1)
			{
				var percent = 0;
				var n=discount.split("_"); 
				if (val == 1) {percent = 0;}
				if ((val > 1) && (val < 6)) {percent = n[0];}
				if ((val > 5) && (val < 11)) {percent = n[1];}
				if (val > 10) {percent = n[2];}
				alert("Discount applied to "+ val +" products: "+percent+" %");
			}
	}
	
	
	
//================================================================================================//	
//========================== SAVE URL - FOOTER IMAGES ============================================//	

		
	
function save_url(url, image, k, order)
{
	var xmlHttp = getXMLHttp();
				 
	  xmlHttp.onreadystatechange = function()
	  {
		if(xmlHttp.readyState == 4)
		{
		  HandleResponse_saveUrl(xmlHttp.responseText, k);
		}
	  }

	  xmlHttp.open("GET", "save_url.php?url="+url+"&image="+image+"&order="+order, true);
	  xmlHttp.send(null);		  
}	



	function HandleResponse_saveUrl(response, k, order)
	{
		document.getElementById('statlabel'+k).innerHTML = response;
	}		
	

//================================================================================================//	

	
	
	
	
		
//================================================================================================//	
//===================== Edit Widgets =============================================================//	

function changeWidget(widget)
{       
         
	if (widget == 'syst_flexbanner') { 
		hide_all();
		document.getElementById('syst_flexbanner').style.display = 'block'; 	
		}
	if (widget == 'syst_flexbanner2') { 
		hide_all();
		document.getElementById('syst_flexbanner2').style.display = 'block'; 
		}
	if (widget == 'syst_gallery') { 
		hide_all();
		document.getElementById('syst_gallery').style.display = 'block'; 
		}
        /*if (widget == 'syst_gallery_1') { 
           
		hide_all();                 
		document.getElementById('syst_gallery_1').style.display = 'block'; 
		}
        
        if (widget == 'syst_gallery_2') { 
           
            hide_all();                 
            document.getElementById('syst_gallery_2').style.display = 'block'; 
        }*/
        
        for(var i=1;i<=20;i++) {
            
            if(widget == 'syst_gallery_'+i){
                
                hide_all();                 
                document.getElementById('syst_gallery_'+ i).style.display = 'block'; 
            }
            
        }

		
	var n=widget.indexOf("syst_");
	
	if (n == -1)
	{
		hide_all();
		document.getElementById('elm4div').style.display = 'block'; 
		
		var xmlHttp = getXMLHttp();
					 
		  xmlHttp.onreadystatechange = function()
		  {
			if(xmlHttp.readyState == 4)
			{
			  HandleResponse_file_elm4(xmlHttp.responseText);
			}
		  }

		  xmlHttp.open("GET", "widget-getcontent.php?widget="+widget, true);
		  xmlHttp.send(null);	
	}
}	

        function hide_all() {
            document.getElementById('syst_flexbanner').style.display = 'none';
            document.getElementById('syst_flexbanner2').style.display = 'none';

            for(var i=1;i<=20;i++){
                document.getElementById('syst_gallery_'+i).style.display = 'none';
            }


            document.getElementById('elm4div').style.display = 'none';
        }

	function HandleResponse_file_elm4(response){
		var elems=response.split("|||");
		
		document.getElementById('elm4').value = elems[0];
		document.getElementById('widget_new_title').value = elems[1];
		document.getElementById('widget_selected').value = elems[2];
	}		
	

//================================================================================================//	
//===================== Edit Widget Pages ========================================================//	

function changeWidgetPage(page)
{
	var xmlHttp = getXMLHttp();
				 
	  xmlHttp.onreadystatechange = function()
	  {
		if(xmlHttp.readyState == 4)
		{
		  HandleResponse_file_elm5(xmlHttp.responseText);
		}
	  }

	  xmlHttp.open("GET", "widgetpage-getcontent.php?page="+page, true);
	  xmlHttp.send(null);		  
}	



	function HandleResponse_file_elm5(response){
				
		var pos1 = strpos(response, " [0] => ");
		var pos2 = strpos(response, " [1] => ");
		var pos3 = strpos(response, " [2] => ");
		var pos4 = strpos(response, " [3] => ");
		var pos5 = strpos(response, ")", pos4);
		
		var template_type = response.substr(pos1 + 8, pos2 - pos1 - 11);
		var column_width = response.substr(pos2 + 8, pos3 - pos2 - 11);
		var page_width = response.substr(pos3 + 8, pos4 - pos3 - 11);
		var identificator = response.substr(pos4 + 8, pos5 - pos4 - 8);
				
			
		template_type = template_type.replace(/^\s+|\s+$/g, '') ;
				
		//document.getElementById('the_pagewidth').value = page_width;
		//document.getElementById('the_columnwidth').value = column_width;
		document.getElementById('current_widgetpage').value = identificator;
		
		if (template_type == '2columns-left'){
			document.getElementById('2columns-left').checked = true;
			}
		
		if (template_type == '1column'){
			//document.getElementById('the_columnwidth').value = "";
			document.getElementById('1column').checked = true;
			}
			
		if (template_type == '2columns-right'){
			document.getElementById('2columns-right').checked = true;
			}
		
		if (template_type == '3columns'){
			document.getElementById('3columns').checked = true;
			}	
			
	}			
	
	
	
function loadTemplate(page)
{
	alert(page);

	var xmlHttp = getXMLHttp();
				 
	  xmlHttp.onreadystatechange = function()
	  {
		if(xmlHttp.readyState == 4)
		{
		  HandleResponse_dragdrop_place(xmlHttp.responseText);
		}
	  }

	  xmlHttp.open("GET", "widgetpage_load.php?page="+page, true);
	  xmlHttp.send(null);		  
}	


	function HandleResponse_dragdrop_place(response){
	
		document.getElementById('dragdrop_place').innerHTML = response;
		
	}
	
	
	
	
//---------------------------------------------------------------------------------------------------------//	
//---------------------------------------------------------------------------------------------------------//	
//---------------------- SAVING CONFIGURATION AFTER THE DRAG & DROP PROCESS -------------------------------//	
//---------------------------------------------------------------------------------------------------------//	
	
function saveDragDropContainers(template_type, page_id)
	{			
		var container2 = "";
		var container3 = "";
		var container4 = "";
	
		if (template_type == "3columns")
		{
		//-------------------------- LEFT -----------------------------//
			var mylist=document.getElementById("column2");
			var variable = "";
			
			for (i=0; i<mylist.childNodes.length; i++){
				if (mylist.childNodes[i].nodeName=="LI"){
					
					variable = mylist.childNodes[i].id;
					variable = "L_" + variable + "|";
					container2 = container2 + variable;
					}
				}
				
			
		//-------------------------- CENTER -----------------------------//
			var mylist=document.getElementById("column3");
			var variable = "";
			
			for (i=0; i<mylist.childNodes.length; i++){
				if (mylist.childNodes[i].nodeName=="LI"){
					
					variable = mylist.childNodes[i].id;
					variable = "C_" + variable + "|";
					container3 = container3 + variable;
					}
				}
				
				
		//-------------------------- RIGHT -----------------------------//
			var mylist=document.getElementById("column4");
			var variable = "";
			
			for (i=0; i<mylist.childNodes.length; i++){
				if (mylist.childNodes[i].nodeName=="LI"){
					
					variable = mylist.childNodes[i].id;
					variable = "R_" + variable + "|";
					container4 = container4 + variable;
					}
				}
		
		}
		
		
		
		
		if (template_type == "2columns-left")
		{
		//-------------------------- LEFT -----------------------------//
			var mylist=document.getElementById("column2");
			var variable = "";
			
			for (i=0; i<mylist.childNodes.length; i++){
				if (mylist.childNodes[i].nodeName=="LI"){
					
					variable = mylist.childNodes[i].id;
					variable = "L_" + variable + "|";
					container2 = container2 + variable;
					}
				}
				
			
		//-------------------------- CENTER -----------------------------//
			var mylist=document.getElementById("column3");
			var variable = "";
			
			for (i=0; i<mylist.childNodes.length; i++){
				if (mylist.childNodes[i].nodeName=="LI"){
					
					variable = mylist.childNodes[i].id;
					variable = "C_" + variable + "|";
					container3 = container3 + variable;
					}
				}
				
		}

		
		

		if (template_type == "2columns-right")
		{
		//-------------------------- LEFT -----------------------------//
			var mylist=document.getElementById("column2");
			var variable = "";
			
			for (i=0; i<mylist.childNodes.length; i++){
				if (mylist.childNodes[i].nodeName=="LI"){
					
					variable = mylist.childNodes[i].id;
					variable = "L_" + variable + "|";
					container2 = container2 + variable;
					}
				}
				
			
		//-------------------------- CENTER -----------------------------//
			var mylist=document.getElementById("column3");
			var variable = "";
			
			for (i=0; i<mylist.childNodes.length; i++){
				if (mylist.childNodes[i].nodeName=="LI"){
					
					variable = mylist.childNodes[i].id;
					variable = "C_" + variable + "|";
					container3 = container3 + variable;
					}
				}
				
		}		
		
		
		
		
		if (template_type == "1column")
		{
		//-------------------------- LEFT -----------------------------//
			var mylist=document.getElementById("column2");
			var variable = "";
			
			for (i=0; i<mylist.childNodes.length; i++){
				if (mylist.childNodes[i].nodeName=="LI"){
					
					variable = mylist.childNodes[i].id;
					variable = "L_" + variable + "|";
					container2 = container2 + variable;
					}
				}
		}		
		
	
	
		var xmlHttp = getXMLHttp();
				 
		  xmlHttp.onreadystatechange = function()
		  {
			if(xmlHttp.readyState == 4)
			{
			  //HandleResponse_1(xmlHttp.responseText);
			}
		  }

		xmlHttp.open("GET", "widgetpage-save-config.php?template_type="+template_type+"&page_id="+page_id+"&container2="+container2+"&container3="+container3+"&container4="+container4, true);
		xmlHttp.send(null);		  

	}	
	
			