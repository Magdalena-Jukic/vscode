<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- font library -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'> 

    <!-- icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    
    <style>
        body{
            font-family: "Times New Roman", Times, serif;
        }
        
        #hidden{ 
            display:none;
        }
        #collapseButton{
            height: auto; 
            width: 50px;
            background-color: black;
            color: white;
            text-align: center;}
        #collapseButton:hover{
            background-color: #7F8C8D;
            color:white;
        }       
    </style>
</head>
<body class="m-5">

<script>
        

        function collapse(cell){
            var row = cell.parentElement;
            var target_row = row.parentElement.children[row.rowIndex + 1];
            if (target_row.style.display == 'table-row') {
                cell.innerHTML = '+';
                target_row.style.display = 'none';
            } else {
                cell.innerHTML = '-';
                target_row.style.display = 'table-row';
            }
        }

        $(document).ready(function(){
            $('.editBtn').on('click', function(){
                
                $('#editmodel').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id_zupanije').val(data[1]);
                $('#naziv_zupanije').val(data[2]);

            });
        });


        $(document).ready(function(){
            $('.editBtn_brStan').on('click', function(){
                
                $('#editmodelBrStan').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id_naselja').val(data[0]);
                $('#naziv_naselja').val(data[1]);
                $('#brStan').val(data[2]);

            });
        });
    </script>


<!--model form for edit -->
<div class="modal fade" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="modelLable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="modelLable">Izmijena naziva županije</h5>
      </div>
      <form action="edit.php" method="POST">
        <div class ="model-body">
            <input type="hidden" name="id_zupanije" id="id_zupanije">
            <div class="form-group">
                <label>Naziv županije</label>
                <input type="text" name="naziv_zupanije" class="form-control" placeholder="Unesite novi naziv županije" id="naziv_zupanije">
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="updateData" id="updateData">Save changes</button>
        </div>
      </form>
      
    </div>
  </div>
</div>
<!-- end model form for edit -->


<!--model form for edit_brStan -->
<div class="modal fade" id="editmodelBrStan" tabindex="-1" role="dialog" aria-labelledby="modelLable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="modelLable">Izmijena broja stanovnika</h5>
      </div>
      <form action="edit.php" method="POST">
        <div class ="model-body">
            <input type="hidden" name="id_naselja" id="id_naselja">
            <div class="form-group">
                <label>Naselje: </label>
                <input type="text" name="naziv_naselja" class="form-control" id="naziv_naselja">
                <small class="form-text text-muted">Cannot be changed.</small>
            </div>
            <div class="form-group">
                <label>Broj stanovnika: </label>
                <input type="text" name="brStan" class="form-control" placeholder="Unesite broj stanovnika" id="brStan">
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="updateData_brStan" id="updateData_brStan">Save changes</button>
        </div>
      </form>
      
    </div>
  </div>
</div>
<!-- end model form for edit_brStan -->

     <h1 class="fw-bold d-flex justify-content-center">Županije u Hrvatskoj</h1>

    
    <?php       
            
            if(isset($_REQUEST['delete'])){
             
                $sql = "DELETE FROM zupanije WHERE id= '". $_REQUEST["id"]."'";
                if(mysqli_query($mysqli_conn, $sql)){
                    echo "<script> alert('Deleted')</script>";
                }else{
                    echo "<script> alert('Error!!')</script>";
                }  
            }           

            $stmt = "SELECT * , SUM(brojStanovnika) AS Sum FROM naselja GROUP BY zupanija";
            $naselja = mysqli_query($mysqli_conn, $stmt);


            $zupanija_array = array();
            foreach($naselja as $naselje){
                $zupanija_array[$naselje["zupanija"]] = $naselje["Sum"];
               
            }


            $array_temp_min = array(); 
            for ($i=0; $i < 3 ; $i++) { 
                $min = min($zupanija_array);

                foreach ($zupanija_array as $key => $value) {
                    if($min == intval($value)){
                            
                        $array_temp_min[$key] = $min; 
                        unset($zupanija_array[$key]); 
                    }
                }
            }
        
        print("<br>");
        $div_min_zup = "<u><span class='fs-5'> 3 županije s najmanjim brojem stanovnika: </span></u><br>";
        $min_zup = min($array_temp_min);
        $i=1;
        foreach ($array_temp_min as $key => $value) {
            if($min_zup == intval($value)){
                $div_min_zup .= "<span class='fw-bold'> ".$i.". županija: " . $key ." broj stanovnika: ". $value ."</span><br>";
            }else{
                $div_min_zup .= $i. ". županija: " . $key ." broj stanovnika: ". $value ."<br>";   
            }
            $i++;
        }
    
        print("<div class='container'><div class='row'><div class='col-sm'>" .$div_min_zup . "</div> ");

        $array_temp_max = array(); 
        for ($i=0; $i < 3 ; $i++) { 
            $max = max($zupanija_array);
            foreach ($zupanija_array as $key => $value) {
                if($max == intval($value)){
                        
                    $array_temp_max[$key] = $max;
                    unset($zupanija_array[$key]);

                }
            }

        }

        $div_max_zup = "<u><span class='fs-5'>3 županije s najvećim brojem stanovnika: </span></u> <br>";
        $max_zup = max($array_temp_max);
        $i=1;
        foreach ($array_temp_max as $key => $value) {
            if($max_zup == intval($value)){
                $div_max_zup .= "<span class='fw-bold'> ".$i.". županija: " . $key ." broj stanovnika: ". $value ."</span><br>";
            }else{
                $div_max_zup .= $i. ". županija: " . $key ." broj stanovnika: ". $value ."<br>";   
            }
            $i++;
            
        }
        print("<div class='col-sm'>" .$div_max_zup . "</div></div></div><br>");



        $stmt = "SELECT * FROM naselja ";
        $naselja = mysqli_query($mysqli_conn, $stmt);

        $stmt1 = "SELECT * FROM zupanije ";
        $zupanije = mysqli_query($mysqli_conn, $stmt1);


        print("<br>");
        $table_zupanije = "<table class='table table-hover'><tr><th class='text-white bg-dark text-center fs-4' colspan=4>Županije</th></tr>";
        

        foreach ($zupanije as $zupanija) {
            $table_zupanije .= "<tr><td id='collapseButton' onclick='collapse(this)'>+</td><td style='display:none;'> ".$zupanija["id"] ."</td>
            <td> ".$zupanija["naziv"]."</td><td><form action='' method='POST'>
            <input type='hidden' name='id' value='".$zupanija['id']."'>
            <input type='hidden' name='name' value='".$zupanija['naziv']."'>
            <input type='submit' class='btn btn-sm btn-danger' name='delete' value='Delete'></form></td>
            <td><button type='button' class='btn btn-success editBtn'>Edit</button></td></tr><tr id='hidden'>";
            $table_zupanije .= "<td></td><td><table class='table'> <tr><th>Naselje</th><th colspan=2>Broj stanovnika</th>";
            foreach ($naselja as $naselje) {
                if($zupanija["naziv"] == $naselje["zupanija"]){
                    $table_zupanije .=  " <tr><td style='display:none;'> ".$naselje["id"] ."</td><td>".$naselje["naselje"]."</td><td>".$naselje["brojStanovnika"]."</td>
                    <td><button type='button' class='btn btn-success editBtn_brStan'> Edit</button></td></tr>";
                    
                }
            }
            $table_zupanije .= "</tr></table></td></tr>";

        }
        $table_zupanije .="</table>";
        print($table_zupanije);

        ?>
       

        
   
</body>
</html>