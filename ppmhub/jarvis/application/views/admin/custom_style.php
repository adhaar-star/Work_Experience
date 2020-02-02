<style type="text/css" media="screen">
    .ace_editor {
        position: relative !important;
        border: 1px solid lightgray;
        margin: auto;
        height: 600px;
        width: 100%;
        font-size: 20px;
    }

    .scrollmargin {
        height: 100px;
        text-align: center;
    }
</style>
<br/>
<div class="content">
    <div class="wrap uk-width-7-10">
        <div class="single-page uk-animation-fade">
            <div class="single-page-artical">
                <div class="artical-content">
                    <h2><i class="uk-icon-paint-brush"></i> Custom Style <span class="uk-text-muted">(Edit the website css file)</span>
                    </h2>
                    <hr class="uk-article-divider">
                    <?php echo PUBPATH . 'assets/themes/default/css/style.css' ?>
                    <?php
                    $attributes = array(
                        'class' => 'uk-form uk-form-stacked',
                        'method' => 'post'
                    );
                    echo form_open('', $attributes) ?>
                    <div class="uk-form-row uk-margin-top uk-panel-box uk-text-center">
                        <button
                            class="uk-button uk-button-large uk-width-1-1 uk-button-success"><span
                                class="uk-h3">Save</span>
                            <i class="uk-icon-save"></i></button>

                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="css-file">Style.css</label>

                        <div id="editor"><?php echo $fp ?></div>
                        <div class="uk-form-controls">
                                <textarea id="content" name='css-file'
                                          class="uk-width-100 uk-form-large uk-hidden uk-margin-bottom"
                                    ></textarea>
                        </div>
                    </div>
                    <div class="uk-form-row uk-margin-top uk-panel-box uk-text-center">
                        <button
                            class="uk-button uk-button-large uk-width-1-1 uk-button-success"><span
                                class="uk-h3">Save</span>
                            <i class="uk-icon-save"></i></button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- load ace -->
<script src="<?php echo base_url() ?>assets/themes/<?php echo $this->selected_theme ?>/ace/src/ace.js"></script>
<script>

    var textarea = $('#content');

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/tomorrow");


    editor.getSession().on('change', function () {
        textarea.val(editor.getSession().getValue());
    });

    textarea.val(editor.getSession().getValue());
</script>
