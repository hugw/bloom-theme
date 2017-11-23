/**
 * Share popup
 */
jQuery(document).ready(($) => {
  $('.popup').click(function () {
    const left = ($(window).width() - 575) / 2
    const top = ($(window).height() - 450) / 2
    const opts = `status=1,width=575,height=450,top=${top},left=${left}`
    window.open(this.href, '_blank', opts)

    return false
  })
})

/**
* Social share counters
*/
jQuery(document).ready(($) => {
  $(window).load(() => {
    const $els = $('.post-share')
    const formatter = num => (num > 999 ? `${(num / 1000).toFixed(1)}k` : num)

    if ($els.length) {
      $els.each(function () {
        const $this = $(this)
        const url = $this.data('url')

        if (typeof url === 'undefined') return
        const fbUrl = `https://graph.facebook.com/v2.11/?id=${url}&access_token=${window.fbToken}&fields=engagement` // eslint-disable-line

        $.get(fbUrl, (res, status, jqXHR) => {
          const $counter = $this.find('.post-share_counter')
          let count = 0

          if (jqXHR.status === 200 && status === 'success') {
            count = Object.values(res.engagement).reduce((a, b) => a + b, 0)
          }

          if (count) $counter.show().find('span').text(formatter(count))
        })
      })
    }
  })
})

/**
 * Add related posts
 * positioning inside content
 * when available
 */
jQuery(document).ready(($) => {
  const $related = $('.relatedposts')
  const $placeholder = $('.post-content p').contents().map(function () {
    return (this.nodeType === 8) ? $(this).parent() : null
  })

  if ($related.length && $placeholder.length) {
    $placeholder[0].replaceWith($related)
  }
})
