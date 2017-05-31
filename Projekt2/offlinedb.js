
var idbSupported = false;
var db;

function load() {
    if ("indexedDB" in window) {
        idbSupported = true;
    }else {
        concole.log("IndexedDB not supported");
    }
    if (idbSupported) {
        var openRequest = window.indexedDB.open("baza1", 3);
        openRequest.onupgradeneeded = function (e) {
            console.log("onupgradeneeded");
            var thisDB = e.target.result;
            if (!thisDB.objectStoreNames.contains("ankiety")) {
                var baza = thisDB.createObjectStore("ankiety", {autoIncrement:true});
                baza.createIndex("płeć", "plec", {unique:false});
                baza.createIndex("ilosc", "ilosc", {unique:false});
                baza.createIndex("gatunek", "gatunek", {unique:false});
                baza.createIndex("date", "date", {unique:false});
            }

        }
        openRequest.onsuccess = function (e) {
            console.log("Success!");
            db = e.target.result;
			document.querySelector("#addButton").addEventListener("click", addAnkieta, false);
		document.querySelector("#getButton").addEventListener("click", getAnkieta, false);
        }
        openRequest.onerror = function (e) {
            console.log("Error");
            console.dir(e);
        }
    }
}

function addAnkieta(e) {
    var transaction = db.transaction(["ankiety"], "readwrite");
    var store = transaction.objectStore("ankiety");
    var plec = $('input[name="gender"]:checked').val();
    var ilosc = $('input[id="ilosc"]').val();
	var e = document.getElementById("gatunek");
	var str = e.options[e.selectedIndex].value;
    var ankieta = {
        gender: plec,
        ilosc: ilosc,
        gatunek: str,
        date: new Date()
    };
    var request = store.add(ankieta);
    request.onerror = function (e) {
        console.log("Error", e.target.error.name);
    };

    request.onsuccess = function (e) {
        console.log("Dodano");
	alert("Dodano poprawnie");
    }
}


function getAnkieta(e) {
    var s = "";
    db.transaction(["ankiety"], "readonly").objectStore("ankiety").openCursor().onsuccess = function(e) {
        var cursor = e.target.result;
        if(cursor) {
			s+="<table  class=\"fulltable\" >";
            s += "<tr><th>Nr Ankiety</th><th > Płeć</th><th>Ilosć</th><th>Nr Gatunku</th><th>Data</th></tr>";
			s+="<tr>";
			var it = 0;
            for(var field in cursor.value) {
				if(it==0){ s+= "<td>"+cursor.key+"</td>";}
                s+= "<td>" +cursor.value[field]+"</td>";
				it++;
            }
            s+="</tr></table>";
            cursor.continue();
        }
        document.getElementById('info').innerHTML = s;
    }

}

function synchronizuj() {
	var params = [,,] ; 
	var transaction = db.transaction(['ankiety'],'readwrite');
	var store = transaction.objectStore('ankiety');
			var cursor = store.openCursor();
			cursor.onsuccess = function(e) {
			var res = e.target.result;
			if (res){
				var i =0;
				for (var field in res.value)
				{
					params[i] = res.value[field];
					i++;
					if(i==3){break;}
				}
			var data = {
             gender: params[0],
             ilosc: params[1],
			 gatunek: params[2]
			};

			$.post("synchronizuj.php", data);
			document.getElementById('info').innerHTML = "Zsynchronizowano i usunięto zapisane rekordy offline.";
			res.continue();
			}
			var request = store.clear();	
			}
		
	
			
}

