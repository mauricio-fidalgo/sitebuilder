var Utils = {
    slug: function(string) {
        var patterns = [
            /À|à|Á|á|å|Ã|â|Ã|ã/g,
            /È|è|É|é|Ê|ê|ẽ|Ë|ë/g,
            /Ì|ì|Í|í|Î|î/g,
            /Ò|ò|Ó|ó|Ô|ô|ø|Õ|õ/g,
            /Ù|ù|Ú|ú|ů|Û|û|Ü|ü/g,
            /ç|Ç/g,
            /ñ|Ñ/g,
            /ä|æ|Ä|ä/g,
            /Ö|ö/g,
            /ß/g,
            /[^\w\s]/g,
            /\s/g,
            /^-+|-+$/g,
            /-{2,}/g
        ];
        var replaces = ['a', 'e', 'i', 'o', 'u', 'c', 'n', 'ae', 'oe', 'ss', ' ', '-', '', '-'];
        
        $.each(patterns, function(i, pattern) {
            string = string.replace(pattern, replaces[i]);
        });
        
        return string.toLowerCase();
    }
};

$(function() {
    // load themes for selected segment
    $('#FormSegment').change(function() {
        var self = $(this);
        if(self.val()) {
            $.get('/segments/view/' + self.val(), {}, function(response) {
                var themes = response.themes;
                var theme_select = $('#FormTheme');
                $('option', theme_select).slice(1).remove();

                $.each(themes, function(key, value) {
                    var option = $('<option />').html(value).attr('value', key);
                    option.appendTo(theme_select);
                });
            });
        }
    }).change();
    
    // create slug for domain name from site title
    var updateSlug = function() {
        var slug = Utils.slug($(this).val());
        $('#FormDomain').val(slug + '.meumobi.com');
    };
    $('#FormTitle').bind({
        keyup: updateSlug,
        blur: updateSlug
    }).blur();
});