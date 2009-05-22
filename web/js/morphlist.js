var SlideList = new Class({
	Implements: [Events,Options],

	options:{
		transition:Fx.Transitions.Sine.easeInOut,
		duration: 500,
		wait: false,
		onClick: $empty
	},

	initialize: function(menu, options) {
		this.setOptions(options);
		this.menu = $(menu), this.current = this.menu.getElement('li.current');

		$$(this.menu.getElements('li')).addEvents({
			'mouseover':this.moveBg.bind(this),
			'mouseout':this.moveBg.bind(this,false),
			'click':this.clickItem.bind(this)
		});

		this.back = new Element('li',{
			'class':'background',
			morph:this.options
		}).adopt(new Element('div',{'class':'left'})).inject(this.menu);
		if(this.current) this.setCurrent(this.current);
	},

	setCurrent: function(el, effect){
		this.back.setStyles({left: (el.offsetLeft), width: (el.offsetWidth)});
		(effect) ? this.back.get('morph').start({'opacity':[0,1]}) : this.back.setStyle('opacity',1);
		this.current = el;
	},

	clickItem: function(event) {
		var item = $(event.target);
		this.setCurrent(item, true);
		this.fireEvent('onClick',[new Event(event), item]);
	},

	moveBg: function(to){
		if(!this.current) return;
		if(to){
			to = $(to.target);
		}else{
			to = this.current;
		}
		this.back.get('morph').start({
			left: to.offsetLeft,
			width: to.offsetWidth
		});
	}
});