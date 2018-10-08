<div class="container mx-sm-auto pb-4 pb-md-5 px-2 shadow-sm rounded text-muted">
    <h1><?php echo $lang['faq']['title'];?></h1>
    <div>
        <?php echo $lang['faq']['info'];?>
    </div>
    <ul class="list-group">
        <?php 
            $query = $CONN->db->query('
                select 
                    faq_question_translation.questionTranslated,
                    faq_answer_translation.answerTranslated
                from
                    faq_link
                left join
                    faq_question_translation
                on
                    faq_link.faq_link_ID = faq_question_translation.faq_link_ID
                left join
                    faq_answer_translation
                on
                    faq_link.faq_link_ID = faq_answer_translation.faq_link_ID
                where
                    faq_question_translation.langCode = "'.$selectedLang.'"
                and
                    faq_answer_translation.langCode = "'.$selectedLang.'"
            ');
            while($fetch = $query->fetch_object()){
                echo '
                    <li class="list-group-item list-group-item-light"><h5 class="mb-0">'.$fetch->questionTranslated.'</h5></li>
                    <div class="pt-1 px-4 text-justify">
                        '.$fetch->answerTranslated.'
                    </div>
                ';
            }
        ?>
    </ul>
</div>