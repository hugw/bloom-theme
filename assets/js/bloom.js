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
    const $els = $('.entry-share')

    if ($els.length) {
      $els.each(function () {
        const $this = $(this)
        const url = $(this).data('url')

        if (typeof url === 'undefined') return

        const fbUrl = `https://graph.facebook.com/?id=${url}`

        $.get(fbUrl, ({ share }, status, jqXHR) => {
          if (jqXHR.status === 200 && status === 'success') {
            const count = share.share_count + share.comment_count
            $this.find('.entry-share_counter').text(count)
          }
        })
      })
    }
  })
})
