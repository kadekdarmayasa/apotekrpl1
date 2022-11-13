$(document).ready(() => {
	var panelOne = $('.form-panel.two').height(),
		panelTwo = $('.form-panel.two')[0].scrollHeight;

	$('.form-panel.two')
		.not('.form-panel.two.active')
		.on('click', (event) => {
			event.preventDefault();

			$('.form-toggle').addClass('visible');
			$('.form-panel.one').addClass('hidden');
			$('.form-panel.two').addClass('active');
			$('.form').animate(
				{
					height: panelTwo,
				},
				200,
			);
		});

	$('.form-toggle').on('click', (event) => {
		event.preventDefault();
		$(this).removeClass('visible');
		$('.form-panel.one').removeClass('hidden');
		$('.form-panel.two').removeClass('active');
		$('.form').animate(
			{
				height: panelOne,
			},
			200,
		);
	});
});
