<div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name="config[title]" value="<?php echo $this->title ?>" id="exampleInputEmail1" placeholder="Title">
    <label for="exampleInputEmail1">class</label>
    <input type="text" class="form-control" name="config[class]" value="<?php echo $this->class ?>" id="exampleInputEmail1" placeholder="Title">
    <label for="exampleInputEmail1">urutan</label>
    <select name="config[urutan]" class="form-control">
        <option value="DESC">Descending</option>
        <option value="ASC">Ascending</option>
    </select>
</div>