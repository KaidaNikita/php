<?php include "_header.php"; ?>


<div class="row mt-3">
    <div class="offset-md-3 col-md-6">
        <div class="form-group">
        <label for="R">R:</label>
        <input type="text" id="R" value="100"/>
        </div>
        <div class="form-group">
        <label for="G">G:</label>
        <input type="text" id="G" value="0"/>
        </div>
        <div class="form-group">
        <label for="B">B:</label>
        <input type="text" id="B" value="0"/>
        </div>
        <div class="form-group">    
        <button id="btn">Accept</button>
        </div>
        <div class="form-group">    
        <span id="Span">Hello World!</span>
        </div>
    </div>

</div>

<?php include "_scripts.php"; ?>

<script>
    $(function() {
        $('#btn').bind("click",function(){
            let r=$('#R').val();
        let g=$('#G').val();
        let b=$('#B').val();

        $('#Span').attr("style",`background-color: rgb(${r}, ${g}, ${b});`)
     });
    })
</script>    

<?php include "_footer.php"; ?>