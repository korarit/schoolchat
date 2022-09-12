let data = res.data;

        let i = 0;
        for(list in data){

          var row = table.insertRow(0);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);
          var cell5 = row.insertCell(4);
          

          cell1.innerHTML = i;
          cell2.innerHTML = data;
          cell3.innerHTML = "NEW CELL2";
          cell4.innerHTML = "NEW CELL2";
          cell4.innerHTML = "NEW CELL2";

          i += 1;
        }