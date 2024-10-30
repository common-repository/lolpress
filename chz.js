(function($){
 $(document).ready(
	function() {
		$("img.size-full").each(function(i) {

			var cbc = '?chzredirect=create&chzurl='
			var cbv = '?chzredirect=view&chzurl='
			var src = $(this).attr('src');
			$(this).removeAttr('title');

			$(this).qtip({
			position: {
				target: 'mouse',
				adjust: { mouse: 'false' }
		   },

			show: { when: { event: 'mouseover' } },
			hide: { when: 'mouseout', fixed: true, delay: 420 },
			content: '<table><tr><td><img src="'+chzlogourl+'"></td><td><a class="chz" href="'+cbc+escape(src)+'" target="_blank">Caption This Image</a><br/><a class="chz" href="'+cbv+escape(src)+'" target="_blank">View Other Captions</a></td></tr></table>'
			});
		});

		$("a img.size-thumbnail").each(function(i) {

			var cbc = '?chzredirect=create&chzurl='
			var cbv = '?chzredirect=view&chzurl='
			var src = $(this).parent("a").attr('href');
			$(this).removeAttr('title');

			$(this).qtip({
			position: {
				target: 'mouse',
				adjust: { mouse: 'false' }
		   },

			show: { when: { event: 'mouseover' } },
			hide: { when: 'mouseout', fixed: true, delay: 420 },
			content: '<table><tr><td><img src="'+chzlogourl+'"></td><td><a class="chz" href="'+cbc+escape(src)+'" target="_blank">Caption This Image</a><br/><a class="chz" href="'+cbv+escape(src)+'" target="_blank">View Other Captions</a></td></tr></table>'
			});
		});
	});
})(jQuery);
