<?php
    # this peice of code is responsible for creating and updating streams
    

    #creating a new stream
    function createstream ($stream_name)
    {
        include ("../library/database/config.php");

        $sql = "INSERT INTO $streams (stream_name) VALUES ('$stream_name')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            # query executed successfully
            return true;
        }else{
            return false;
        }
    }

    #fetching new stream
    function fetchstream()
    {
        include ("../library/database/config.php");

        $sql = "SELECT * FROM $streams ";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr><td>".$row['stream_name']." <form method ='POST'> <button type='submit' name='update' value='".$row['id']."'>Update</button><button type='submit' name='delete' value='".$row['id']."'>Delete</button></form><td></tr>";
                }
            }else{
                echo "<tr><td>NO DATA FOUND<td></tr>";
            }
            
        }else{
            echo "<tr><td>Error Occured<td></tr>";
        }
    }

    #deleting a stream
    function deletestreame($delete){
        include ("../library/database/config.php");

        $sql = "DELETE FROM $streams WHERE id = $delete";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            # Query OK
            return true;
        }else{
            # Error in Query
            return false;
        }
    }

    #creating update form
    function updateform($update){
        // echo "<script>alert('$update');</script>";
        include ("../library/database/config.php");

        $sql = "SELECT * FROM $streams WHERE id = $update";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $result = mysqli_fetch_assoc($query);
            echo '
                <form method="POST">
                    <input type = "text" value = "'.$result['stream_name'].'" name="stream_name">
                    <input type = "hidden" value = "'.$update.'" name = "stream_id">
                    <input type = "submit" value = "UPDATE Stream" name = "update_stream">
                </form>
            ';
        }
    }

    #updating existing stream
    function updatestream($id, $update){
        include ("../library/database/config.php");

        $sql = "UPDATE $streams SET stream_name = '$update' WHERE id = $id";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            return true;
        }else{
            return false;
        }
    }
?>