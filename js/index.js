const $ = require('jquery')
const superagent = require('superagent')

superagent.get('/wp-json/glossary/v1/terms')
.then(res => {
    const THEME_GLOSSARY_TERMS = res.body
    const termTitles = THEME_GLOSSARY_TERMS.map(term => term.title)
    scan(termTitles, THEME_GLOSSARY_TERMS)
})

function scan (termTitles, THEME_GLOSSARY_TERMS) {
    const rows = document.querySelectorAll(
        `.wp-glossary-scan`
    )

    let selector = ``
    $.each(termTitles, function (index, value) {
        selector = `p:contains(" ${value} "), p:contains(" ${value.toLowerCase()} ")`

        // use first() to only do the first one
        $(selector, rows)
            .first()
            .html(function (_, html) {
                // Find the paragraph that has these
                const [{ definition, id, disable_formatting }] = THEME_GLOSSARY_TERMS.filter(
                    term => term.title == value
                )


                // Escape regex characters
                value = value.replace(/\$/g, '\\$');

                // not using greedy g, to select, so only to select first
                var regex = new RegExp(value, 'i')

                console.log(disable_formatting);

                let klass_modifier = '';
                if (html.substring(0).search(regex) === 0)
                    klass_modifier = 'inline-glossary-term--start-of-sentance';
                else if (html.substring(0).indexOf('•') === 0)
                    klass_modifier = 'inline-glossary-term--start-of-sentance';
                else if (disable_formatting)
                    klass_modifier = 'inline-glossary-term--start-of-sentance';

                return html.replace(
                    regex,
                    `<span class="inline-glossary-term ${klass_modifier}" data-glossary-term-id="${id}"></span>`
                )
            })
    })

    // Add the definitions
    $(`span[data-glossary-term-id]`, rows).each(function (ind, el) {
        const [{ title, definition }] = THEME_GLOSSARY_TERMS.filter(
            term => term.id == el.dataset.glossaryTermId
        )
        $(el).append(
            `<dfn class="wp-glossary-dfn relative">${title}<div class="wp-glossary-tooltip">
                    <h4 class="wp-glossary-title">${title}</h4>
                    <div class="class="wp-glossary-definition">${definition}</div>
                </div>
            </dfn>`
        )
    })
}

$('body').on('mouseenter', '.inline-glossary-term', function (e) {
    $(e.target)
        .closest('.inline-glossary-term')
        .addClass('hover')
})

$('body').on('mouseleave', '.inline-glossary-term', function (e) {
    $(e.target)
        .closest('.inline-glossary-term')
        .removeClass('hover')
})

$('body').on('touchend', '.inline-glossary-term', function (e) {
    $(e.target)
        .closest('.inline-glossary-term')
        .toggleClass('hover')
})

// if someone clicks off of a glossary term on mobile
// make sure it hides itself
$(document).on('touchstart', function (event) {
    if (!$(event.target).closest('.inline-glossary-term').length) {
        $('.inline-glossary-term.hover').removeClass('hover')
    }
})


$('[data-row-name="find-glossary-terms"] .section-content p:has(strong)').each(function () {
    $(this).addClass("mb--0");
});
