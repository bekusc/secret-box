var $secret_form = $('#tell-your-secret'),
    $send_result = $('#secret-send-result'),
    $publish_button = $('a#publish-btn'),
    $input_age = $("input#age"),
    $form_gender = $('a#form-gender'),
    $search_gender = $('a#search-gender'),
    $vote_button = $('a.smile'),
    $page_input = $("a#page-number"),
    $form_message = $('#form-message'),
    $form_submit = $('#form-submit'),
    $search_submit = $('#search-submit'),
    $show_comments = $('.comments'),
    $moderation = $('.moderation');
    $moderation_btn = $('.mod.btn');

function highlight(word) {

    var elements = $('.content');
    
    elements.each(function () {
        var rgxp = new RegExp(word, 'g');
        var repl = '<span class="marker">' + word + '</span>';

        $(this).html($(this).html().replace(word, repl));
    });
        
}

if (typeof query !== 'undefined') highlight(query);

if (document.cookie.indexOf('secret_posted') >= 0) {

    $secret_form.hide();
    $send_result.show();
};

if (document.cookie.indexOf('votes-') >= 0) {

    var cookie = document.cookie,
        index = cookie.indexOf('votes-'),
        votes = cookie.substring(index).split('; ');

    votes.forEach(function(vote) {
        vote = vote.split('-');
        
        if (vote[0] == 'votes') {
            vote[1] = vote[1].split('=');

            $votes_element = $('ul.votes[data-title=' + vote[1][0] + ']');
            $votes_button = $votes_element.find('a.smile[data-type=' + vote[1][1] + ']');

            $votes_button.addClass('active');
        };

    });
};

$input_age.keypress(function(e) {

    if (e.which != 8 && (e.which < 48 || e.which > 57))
        return false;
});

$publish_button.click(function () {

    $("header.secret-box").slideToggle("fast");
})

$form_gender.click(function () {

    $(this).addClass('active').parent().siblings().find('a').removeClass('active');
});

$search_gender.click(function () {

    $(this).toggleClass('active');
});

$vote_button.click(function () {

    var $this = $(this),
        $parent_element = $this.parent().parent();

    var post_title = $parent_element.data('title'),
        type = $this.data('type'),
        is_active = $this.hasClass('active');

    if (!is_active) {

        $.ajax({
            method: "POST",
            url: "/vote",
            data: {
                post_title: post_title,
                type: type
            },
            success: function(data) {
                $parent_element.find('li.count').text(data);
            }
        });

        $this.addClass('active');
        $this.parent().siblings().find('a').removeClass('active');

    }
});

$page_input.click(function() {

    $(this).hide();
    $(this).next().show().focus();

    $(this).next().keypress(function(e) {

        if(e.which == 10 || e.which == 13) {
            window.location.href = "/" + $(this).val();
        }
        else if (e.which != 8 && (e.which < 48 || e.which > 57 )) {
            return false;
        } 
    })
});

$form_message.keyup(function () {

    var $counter = $('#secret-counter');

    var max = 500,
        len = $(this).val().length,
        char = max - len;
    
    $counter.text(char);
    
    if (len < 50) {
        $form_submit.addClass('disabled');
    }
    else if (char < 0) {
        $counter.css('background-color', '#e83224');
        $form_submit.addClass('disabled');
    }
    else {
        $counter.css('background-color', '#27AE61');
        $form_submit.removeClass('disabled');
    }
    
});

$form_submit.click(function() {

    if (!$(this).hasClass('disabled')) {

        var age = $('#age').val();
            gender = $('a.active').data('value');

        var ageCheck = (age > 13 && age < 80),
            genderCheck = (gender > 0 && gender < 3);

        if (!ageCheck || !genderCheck || $form_message.val().length < 50) {
            $('#error-zone').show();
        }
        else {
            $secret_form.hide();
            $send_result.show();

            $.ajax({
                method: "POST",
                url: "/create",
                data: {
                    form_message: $form_message.val(),
                    age: age,
                    gender: gender
                }
            });
        }
    };
});

$search_submit.click(function() {

    var $search_form = $('#search-form'),
        $gender = $search_form.find('.active');

    var query = $search_form.find('#search-query').val().trim(),
        age = parseInt($search_form.find('#age').val()),
        gender = 3;

    if ($gender.size() == 1) gender = $gender.data("value");
    if (!age) age = 1;

    window.location.href = "/search/" + query + "/" + age + "/" + gender;
});

$show_comments.click(function() {

    var $comments_box = $(this).parent().next(),
        title = $(this).data('title');
        
    $comments_box.toggle();
    $(this).toggleClass('opened');

    if (!$comments_box.hasClass("loaded")) {

        $comments_box.addClass("loading").append('<div class="fb-comments" data-href="' + location.host + '/seg/' + title + '" data-width="600" data-numposts="10"></div>');
        
        FB.XFBML.parse(document.getElementById("comments-" + title), function() {
            $comments_box.addClass("loaded").removeClass("loading")
        })
    }
});

$moderation_btn.click(function() {
    
    var title = $moderation.data('title'),
        mode = $(this).data('type');

    $.ajax({
        method: "POST",
        url: "/post_mod",
        data: {
            title: title,
            mode: mode,
        },
        success: function () {
            location.reload();
        }
    });

});