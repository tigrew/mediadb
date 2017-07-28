<div class="row">
    <div class="col-md-4">
        <form class="form" method="post" enctype="multipart/form-data" action="/mediadb/index.php?controller=Album&action=edit">
            <div class="form-group ">
                <label class="control-label requiredField" for="title">
                    Title
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <div class="input-group">
                    <div class="input-group-addon">
                        Album title
                    </div>
                    <input class="form-control" id="title" name="title" placeholder="Title" type="text"/>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="date">
                    Date
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input class="form-control" id="date" name="releasedate" placeholder="DD/MM/YYYY" type="date"/>
            </div>
            <div class="form-group ">
                <label class="control-label " for="text">
                    Number of songs
                </label>
                <input class="form-control" id="text" name="numbersong" placeholder="For example : 1 - 10" type="number"/>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="number">
                    Stock
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input class="form-control" id="number" name="stock" type="number"/>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="price">
                    Price
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input class="form-control" id="price" name="price" placeholder="€" type="number"/>
            </div>
            <div class="form-group">
                <div>
                    <button class="btn btn-primary " value="Add_Album" name="submit" type="submit">
                        Submit
                    </button>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="price">
                    Cover Upload
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input type="file" name="cover" id="fileToUpload">            
            </div>
        </form>
    </div>
</div>

