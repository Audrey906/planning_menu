function print() {    
	var infoToPrint = document.getElementById('planningArray');
	var content = window.open('', '_blank');
    $(".dontPrint").css("display", "none");

    $(".col-md-1").css("min-width", "130px");
	content.document.open();
    header = '<head><script src="https://kit.fontawesome.com/8a9e68092d.js" crossorigin="anonymous"></script> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> <link rel="stylesheet" href="\'../../css/style.css\'"></head>'
	content.document.write('<html>' + header + '<body onload="window.print()">' + infoToPrint.innerHTML + '</html>');
	content.document.close();

    $(".col-md-1").removeProperty("min-width");
    $(".dontPrint").css("display", "block");
}