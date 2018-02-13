/* Functions */
var triggerTree = null;

/* Objects */
var PageOverlay = {};

/* Init events */
(function($) {

if ( ! $) return;

/* Define fn */
triggerTree = function(el) {
	var $el = $(el);
	var raw = $el.get(0);
	if (raw) {
		var tvLink = $el.parent().closest('li.treeview');
		var raw = tvLink.get(0);
		if (raw) {
			var lnk = tvLink.find('> a');
			tvLink.find('> a').trigger('click');
			console.log(lnk.get(0));
			console.log(raw);
			triggerTree(raw);
		}
	}
};

/* Define obj */
// PageOverlay = Object.assign({}, PageOverlay, {
PageOverlay = {
	overlay: $('<div class="overlay-wrapper"><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>'),
	plainOverlay: $('<div class="overlay-wrapper"><div class="overlay"></div></div>'),
	show: function($plain) {
		if ($plain) {
			this.plainOverlay.appendTo('body');
			return this.plainOverlay.get(0);
		}
		else {
			this.overlay.appendTo('body');
			return this.overlay.get(0);
		}
	},
	hide: function() {
		this.overlay.detach();
		this.plainOverlay.detach();
		// return this.overlay.get(0);
		return;
	}
// });
};

window.addEventListener('load', function() {
	/* Open active sidebar */
	var cPath = location.pathname;
	var cPathFull = location.href;

	var cmLink = $('a[href="' + cPath + '"], a[href="' + cPathFull + '"]');

	cmLink.each(function(ndx) {
		$(this).closest('li').addClass('active');
		triggerTree(this);
	});

	var caEls = $('.callout, .alert');
	var caCountInfo = caEls.find('.ca-countdown');

	caCountInfo.each(function(){
		var el = $(this);
		el.show();
		var timeLeft = 5;
		var caCountdown = setInterval(function() {
			if ( ! timeLeft) {
				clearInterval(caCountdown);
				return;
			}
			el.text("Closing in " + timeLeft + " seconds");
			timeLeft--;
		}, 1000);
	});

	var caTimeout = setTimeout(function() {
		caEls.remove();
	}, 6000);


	/* Close preloading screen */
	setTimeout(function() {
		$('body').toggleClass('loaded');
		PageOverlay.show('plain');
		setTimeout(function() {
			PageOverlay.hide();
		},1000);
	}, 500);

});

window.addEventListener('beforeunload', function() {
	// Do something here
});

console.log("Scripts run successfully");

})(window.jQuery);
