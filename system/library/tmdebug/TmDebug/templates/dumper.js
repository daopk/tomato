/**
 * Dumper
 *
 * This file is part of the Tomato Debug (https://github.com/daofresh/tomato)
 */

(function(){

	var $ = TmDebug.Query.factory;

	var Dumper = TmDebug.Dumper = {};

	Dumper.init = function() {
		$(document.body).bind('click', function(e) {
			var link;

			// enables <span data-tmdebug-href=""> & ctrl key
			for (link = e.target; link && (!link.getAttribute || !link.getAttribute('data-tmdebug-href')); link = link.parentNode) {}
			if (e.ctrlKey && link) {
				location.href = link.getAttribute('data-tmdebug-href');
				return false;
			}

			if (e.shiftKey || e.altKey || e.ctrlKey || e.metaKey) {
				return;
			}

			// enables <a class="tmdebug-toggle" href="#"> or <span data-ref="#"> toggling
			link = $(e.target).closest('.tmdebug-toggle');
			if (!link.length) {
				return;
			}
			var collapsed = link.hasClass('tmdebug-collapsed'),
				ref = link[0].getAttribute('data-ref') || link[0].getAttribute('href', 2),
				dest = ref && ref !== '#' ? $(ref) : link.next(''),
				panel = link.closest('.tmdebug-panel'),
				oldPosition = panel.position();

			link[collapsed ? 'removeClass' : 'addClass']('tmdebug-collapsed');
			dest[collapsed ? 'removeClass' : 'addClass']('tmdebug-collapsed');
			e.preventDefault();

			if (panel.length) {
				var newPosition = panel.position();
				panel.position({
					right: newPosition.right - newPosition.width + oldPosition.width,
					bottom: newPosition.bottom - newPosition.height + oldPosition.height
				});
			}
		});
	};

})();
