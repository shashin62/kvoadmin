<div class="container-fluid">
    <a href="javascript:void(0);" class="btn btn-primary btn-primary pull-right addArticle"><span class="glyphicon glyphicon-edit"></span>Add Article</a>
</div>
<div class="container-fluid addArticleForm" style="display: none;">
    <?php echo $this->Form->create('Article', array('type' => 'file', 'class' => 'form-horizontal articleForm', 'id' => 'addArticle', 'name' => 'article')); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="title">Title:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <?php echo $this->Form->input('title', array('id' => 'title', 'placeholder' => 'Enter Title', 'title' => '', 'div' => false, 'label' => false, 'class' => 'form-control bname')); ?>
                </div>
            </div>
            <?php echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'id', 'placeholder' => 'Enter Title', 'title' => '', 'div' => false, 'label' => false, 'class' => 'form-control articleid')); ?>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="image_file"></label>
                <div class="col-lg-6 col-md-6 col-xs-6 image-name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="image_file">Upload Image:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <?php echo $this->Form->file('image_file', array('id' => 'image_file', 'placeholder' => 'Upload Image', 'title' => '', 'div' => false, 'label' => false)); ?>
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="author">Author:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <?php echo $this->Form->input('author', array('id' => 'author', 'placeholder' => 'Enter Author Name', 'title' => '', 'div' => false, 'label' => false, 'class' => 'form-control bname')); ?>
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-lg-4 col-md-4 col-xs-4 control-label" for="body">Description:</label>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <?php echo $this->Form->textarea('body', ['rows' => '3', 'cols' => '10', 'class' => 'summernote', 'id' => 'body']); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-1 col-xs-2">
            <div class="form-actions">
                <div class="col-lg-2 col-md-1 col-xs-1">
                    <button type="button" class="btn btn-primary bgButton">Submit</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $this->Form->end(); ?>
</div>
<div class="container-fluid">   
    <h3 class="heading">Articles</h3>
    <table id="getArticle" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<script>
    var successMessage = null;
    <?php if (isset($msg) && $msg['success']) { ?>
        successMessage = '<?php $msg['message'];?>';
    <?php } ?>
</script>
<?php echo $this->Html->css(array('summernote')); ?>
<?php echo $this->Html->script(array('summernote/dist_0.5.1/summernote')); ?>
<?php echo $this->Html->script(array('Master/articles')); ?>