<section class="section-content-window">
    <div class="sub-fields">
        <? if($p['form_fields']): ?>
                <div class="sub-field">
                    <h2><?= $p['form']->fetch_assoc()['title'] ?></h2>
                    <? foreach($p['form_fields'] as $field): ?>
                    <div class="form-element clearfix">
                        <? if($field['type'] == "textarea"): ?>
                            <textarea><?= $field['value']; ?>  </textarea>
                        <? elseif($field['type'] == "input"): ?>
                            <input type="text" value="<?=$field['value']; ?>" />
                        <? endif; ?>
                        <label for=""><?= $field['field_name']; ?></label>
                    </div>
                    <? endforeach; ?>
                </div>
        <? endif; ?>
    </div>
</section>