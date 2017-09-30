
<section class="section-sub-navigation">
    <div class="sub-items">
        <? foreach($p['items'] as $form): ?>
            <div class="sub-item">
                <a href="/management/forms/<?=$form['id'];?>"><span><?= $form['title']; ?></span></a>
                <div class="sub-options">

                </div>
                <ul class="list-labels">
                    <li>Hidden: true</li>
                    <li>Featured: false</li>
                </ul>
            </div>
        <? endforeach; ?>
        <div class="sub-item default">
            <span>Title</span>
            <div class="sub-options">

            </div>
            <ul class="list-labels">
                <li>Hidden: true</li>
                <li>Featured: false</li>
            </ul>
        </div>
    </div>
    <div class="sub-new">
        <i class="icon-plus"></i>
    </div>
</section>