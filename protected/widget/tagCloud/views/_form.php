<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="config[title]" value="<?php echo $this->title ?>" id="exampleInputEmail1" placeholder="Title">
    <label for="class">Class Container</label>
    <input type="text" class="form-control" name="config[class]" value="<?php echo $this->class ?>" id="exampleInputEmail1" placeholder="Title">
    <label for="class">Class Tag</label>
    <input type="text" class="form-control" name="config[tagClass]" value="<?php echo $this->tagClass ?>" id="exampleInputEmail1" placeholder="Title">
    <label for="Jumlah">Jumlah</label>
    <select name="config[jumlah]" class="form-control">
        <option value="10">10 Tag</option>
        <option value="20">20 Tag</option>
        <option value="30">30 Tag</option>
        <option value="40">40 Tag</option>
        <option value="50">50 Tag</option>
    </select>
</div>