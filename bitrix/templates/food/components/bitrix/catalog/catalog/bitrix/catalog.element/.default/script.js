(function (window) {

if (!!window.JCCatalogElement)
	return;

window.JCCatalogElement = function (arParams)
{
	this.productType = 0;
	this.showQuantity = true;
	this.showAbsent = true;
	this.checkQuantity = false;
	this.maxQuantity = 0;
	this.stepQuantity = 1;
	this.isDblQuantity = false;
	this.canBuy = true;
	this.canSubscription = true;
	this.precision = 6;
	this.precisionFactor = Math.pow(10,this.precision);

	this.showOldPrice = false;
	this.showPercent = false;
	this.showSkuProps = false;
	this.showOfferGroup = false;

	this.visual = {
		ID: '',
		PICT_ID: '',
		QUANTITY_ID: '',
		QUANTITY_UP_ID: '',
		QUANTITY_DOWN_ID: '',
		PRICE_ID: '',
		OLD_PRICE_ID: '',
		DISCOUNT_VALUE_ID: '',
		DISCOUNT_PERC_ID: '',
		OFFER_GROUP: ''
	};
	this.product = {
		checkQuantity: false,
		maxQuantity: 0,
		stepQuantity: 1,
		isDblQuantity: false,
		canBuy: true,
		canSubscription: true,
		name: '',
		pict: {},
		id: 0,
		addUrl: '',
		buyUrl: '',
		slider: {},
		sliderCount: 0,
		useSlider: false,
		SLIDER_PICT: []
	};
	this.ajaxPath = '';
	this.mess = {};

	this.basketData = {
		quantity: 'quantity',
		props: 'prop'
	};

	this.defaultPict = {
		preview: null,
		detail: null
	};

	this.offers = [];
	this.offerNum = 0;
	this.treeProps = [];
	this.obTreeRows = [];
	this.showCount = [];
	this.showStart = [];
	this.selectedValues = {};
	this.sliders = [];

	this.obProduct = null;
	this.obQuantity = null;
	this.obQuantityUp = null;
	this.obQuantityDown = null;
	this.obPict = null;
	this.obPrice = {
		price: null,
		full: null,
		discount: null,
		percent: null
	};
	this.obTree = null;
	this.obBuyBtn = null;
	this.obSkuProps = null;
	this.obSlider = null;
	this.obMeasure = null;
	this.obQuantityLimit = {
		all: null,
		value: null
	};

	this.obZoom = {
		cont: null,
		pict: null
	};
	this.enableZoom = false;
	this.showZoom = false;

	this.errorCode = 0;

	if ('object' == typeof(arParams))
	{
		this.productType = parseInt(arParams.PRODUCT_TYPE);
		this.showQuantity = arParams.SHOW_QUANTITY;
		if (!!arParams.SHOW_DISCOUNT_PERCENT)
			this.showPercent = true;
		if (!!arParams.SHOW_OLD_PRICE)
			this.showOldPrice = true;
		if (!!arParams.SHOW_SKU_PROPS)
			this.showSkuProps = true;
		if (!!arParams.OFFER_GROUP)
			this.showOfferGroup = true;
		this.visual = arParams.VISUAL;
		this.ajaxPath = arParams.AJAX_PATH;
		if (!!arParams.MESS)
			this.mess = arParams.MESS;
		switch (this.productType)
		{
			case 1://product
			case 2://set
				if (!!arParams.PRODUCT && 'object' == typeof(arParams.PRODUCT))
				{
					if (this.showQuantity)
					{
						this.product.checkQuantity = arParams.PRODUCT.CHECK_QUANTITY;
						this.product.isDblQuantity = arParams.PRODUCT.QUANTITY_FLOAT;
						if (this.product.checkQuantity)
							this.product.maxQuantity = (this.product.isDblQuantity
									? parseFloat(arParams.PRODUCT.MAX_QUANTITY)
									: parseInt(arParams.PRODUCT.MAX_QUANTITY)
							);
						this.product.stepQuantity = (this.product.isDblQuantity
							? parseFloat(arParams.PRODUCT.STEP_QUANTITY)
							: parseInt(arParams.PRODUCT.STEP_QUANTITY)
						);

						this.checkQuantity = this.product.checkQuantity;
						this.isDblQuantity = this.product.isDblQuantity;
						this.maxQuantity = this.product.maxQuantity;
						this.stepQuantity = this.product.stepQuantity;
						if (this.isDblQuantity)
						{
							this.stepQuantity = Math.round(this.stepQuantity*this.precisionFactor)/this.precisionFactor;
						}
					}
					this.product.canBuy = arParams.PRODUCT.CAN_BUY;
					this.product.canSubscription = arParams.PRODUCT.SUBSCRIPTION;
					this.product.buyUrl = arParams.PRODUCT.BUY_URL;

					this.canBuy = this.product.canBuy;
					this.canSubscription = this.product.canSubscription;

					this.product.name = arParams.PRODUCT.NAME;
					this.product.pict = arParams.PRODUCT.PICT;
					this.product.id = arParams.PRODUCT.ID;

					if (!!arParams.PRODUCT.ADD_URL)
						this.product.addUrl = arParams.PRODUCT.ADD_URL;
					if (!!arParams.PRODUCT.BUY_URL)
						this.product.buyUrl = arParams.PRODUCT.BUY_URL;

					if (!!arParams.PRODUCT.SLIDER_COUNT)
					{
						this.product.sliderCount = parseInt(arParams.PRODUCT.SLIDER_COUNT);
						if (isNaN(this.product.sliderCount))
							this.product.sliderCount = 0;
						if (0 < this.product.sliderCount && !!arParams.PRODUCT.SLIDER.length && 0 < arParams.PRODUCT.SLIDER.length)
						{
							var j = 0;
							for (j = 0; j < arParams.PRODUCT.SLIDER.length; j++)
							{
								this.product.useSlider = true;
								arParams.PRODUCT.SLIDER[j].WIDTH = parseInt(arParams.PRODUCT.SLIDER[j].WIDTH);
								arParams.PRODUCT.SLIDER[j].HEIGHT = parseInt(arParams.PRODUCT.SLIDER[j].HEIGHT);
							}
							this.product.SLIDER_PICT = arParams.PRODUCT.SLIDER;
						}
					}
				}
				else
				{
					this.errorCode = -1;
				}
				break;
			case 3://sku
				if (!!arParams.OFFERS && BX.type.isArray(arParams.OFFERS))
				{
					this.offers = arParams.OFFERS;
					this.offerNum = 0;
					if (!!arParams.OFFER_SELECTED)
						this.offerNum = parseInt(arParams.OFFER_SELECTED);
					if (isNaN(this.offerNum))
						this.offerNum = 0;
					if (!!arParams.TREE_PROPS)
						this.treeProps = arParams.TREE_PROPS;
					if (!!arParams.DEFAULT_PICTURE)
					{
						this.defaultPict.preview = arParams.DEFAULT_PICTURE.PREVIEW_PICTIRE;
						this.defaultPict.detail = arParams.DEFAULT_PICTURE.DETAIL_PICTURE;
					}
				}
				else
				{
					this.errorCode = -1;
				}
				break;
			default:
				this.errorCode = -1;
		}
		if (!!arParams.BASKET && 'object' == typeof(arParams.BASKET))
		{
			if (!!arParams.BASKET.QUANTITY)
				this.basketData.quantity = arParams.BASKET.QUANTITY;
			if (!!arParams.BASKET.PROPS)
				this.basketData.props = arParams.BASKET.PROPS;
		}
	}
	if (0 === this.errorCode)
	{
		BX.ready(BX.delegate(this.Init,this));
	}
};

window.JCCatalogElement.prototype.Init = function()
{
	var i = 0;
	var j = 0;
	this.obProduct = BX(this.visual.ID);
	if (!this.obProduct)
		this.errorCode = -1;
	this.obPict = BX(this.visual.PICT_ID);
	if (!this.obPict)
		this.errorCode = -2;
	this.obPrice.price = BX(this.visual.PRICE_ID);
	if (!this.obPrice.price)
	{
		this.errorCode = -16;
	}
	else
	{
		if (!!this.visual.OLD_PRICE_ID)
		{
			this.obPrice.full = BX(this.visual.OLD_PRICE_ID);
			if (!this.obPrice.full)
				this.errorCode = -17;
		}
		if (!!this.visual.DISCOUNT_VALUE_ID)
		{
			this.obPrice.discount = BX(this.visual.DISCOUNT_VALUE_ID);
			if (!this.obPrice.discount)
				this.errorCode = -18;
		}
		if (this.showPercent)
		{
		if (!!this.visual.DISCOUNT_PERC_ID)
		{
			this.obPrice.percent = BX(this.visual.DISCOUNT_PERC_ID);
			if (!this.obPrice.percent)
				this.errorCode = -19;
		}
		}
	}

	if (this.showQuantity && !!this.visual.QUANTITY_ID)
	{
		this.obQuantity = BX(this.visual.QUANTITY_ID);
		if (!this.obQuantity)
			this.errorCode = -32;
		if (!!this.visual.QUANTITY_UP_ID)
		{
			this.obQuantityUp = BX(this.visual.QUANTITY_UP_ID);
			if (!this.obQuantityUp)
				this.errorCode = -64;
		}
		if (!!this.visual.QUANTITY_DOWN_ID)
		{
			this.obQuantityDown = BX(this.visual.QUANTITY_DOWN_ID);
			if (!this.obQuantityDown)
				this.errorCode = -128;
		}
	}
	if (3 == this.productType)
	{
		if (!!this.visual.TREE_ID)
		{
			this.obTree = BX(this.visual.TREE_ID);
			if (!this.obTree)
				this.errorCode = -256;
			var strPrefix = this.visual.TREE_ITEM_ID;
			for (i = 0; i < this.treeProps.length; i++)
			{
				this.obTreeRows[i] = {
					LEFT: BX(strPrefix+this.treeProps[i].ID+'_left'),
					RIGHT: BX(strPrefix+this.treeProps[i].ID+'_right'),
					LIST: BX(strPrefix+this.treeProps[i].ID+'_list'),
					CONT: BX(strPrefix+this.treeProps[i].ID+'_cont')
				};
				if (!this.obTreeRows[i].LEFT || !this.obTreeRows[i].RIGHT || !this.obTreeRows[i].LIST || !this.obTreeRows[i].CONT)
				{
					this.errorCode = -512;
					break;
				}
			}
		}
		if (!!this.visual.QUANTITY_MEASURE)
		{
			this.obMeasure = BX(this.visual.QUANTITY_MEASURE);
		}
		if (!!this.visual.QUANTITY_LIMIT)
		{
			this.obQuantityLimit.all = BX(this.visual.QUANTITY_LIMIT);
			if (!!this.obQuantityLimit.all)
			{
				this.obQuantityLimit.value = BX.findChild(this.obQuantityLimit.all, {tagName: 'span'}, false, false);
				if (!this.obQuantityLimit.value)
					this.obQuantityLimit.all = null;
			}
		}
	}

	if (!!this.visual.BIG_SLIDER_ID)
	{
		this.obSlider = BX(this.visual.BIG_SLIDER_ID);
		if (!this.obSlider)
		{
			this.errorCode = -1024;
		}
	}
	if (!!this.visual.BUY_ID)
	{
		this.obBuyBtn = BX(this.visual.BUY_ID);
		if (!this.obBuyBtn)
		{

		}
	}
	if (this.showSkuProps)
	{
		if (!!this.visual.DISPLAY_PROP_DIV)
		{
			this.obSkuProps = BX(this.visual.DISPLAY_PROP_DIV);
		}
	}

	if (0 === this.errorCode)
	{
		var SliderImgs = null;
		if (this.showQuantity)
		{
			BX.bind(this.obQuantityUp, 'click', BX.delegate(this.QuantityUp, this));
			BX.bind(this.obQuantityDown, 'click', BX.delegate(this.QuantityDown, this));
			BX.bind(this.obQuantity, 'change', BX.delegate(this.QuantityChange, this));
		}
		switch (this.productType)
		{
			case 1://product
			case 2://set
				if (this.product.useSlider)
				{
					this.product.slider = {
						COUNT: this.product.sliderCount,
						ID: this.visual.SLIDER_CONT,
						CONT: BX(this.visual.SLIDER_CONT),
						LIST: BX(this.visual.SLIDER_LIST),
						LEFT: BX(this.visual.SLIDER_LEFT),
						RIGHT: BX(this.visual.SLIDER_RIGHT),
						START: 0
					};
					SliderImgs = BX.findChildren(this.product.slider.LIST, {tagName: 'li'}, true);
					if (!!SliderImgs && 0 < SliderImgs.length)
					{
						for (j = 0; j < SliderImgs.length; j++)
						{
							BX.bind(SliderImgs[j], 'click', BX.delegate(this.ProductSelectSliderImg, this));
						}
					}
					if (!!this.product.slider.LEFT)
						BX.bind(this.product.slider.LEFT, 'click', BX.delegate(this.ProductSliderRowLeft, this));
					if (!!this.product.slider.RIGHT)
						BX.bind(this.product.slider.RIGHT, 'click', BX.delegate(this.ProductSliderRowRight, this));
				}
				break;
			case 3://sku
				var TreeItems = BX.findChildren(this.obTree, {tagName: 'li'}, true);
				if (!!TreeItems && 0 < TreeItems.length)
				{
					for (i = 0; i < TreeItems.length; i++)
					{
						BX.bind(TreeItems[i], 'click', BX.delegate(this.SelectOfferProp, this));
					}
				}
				for (i = 0; i < this.obTreeRows.length; i++)
				{
					BX.bind(this.obTreeRows[i].LEFT, 'click', BX.delegate(this.RowLeft, this));
					BX.bind(this.obTreeRows[i].RIGHT, 'click', BX.delegate(this.RowRight, this));
				}
				for (i = 0; i < this.offers.length; i++)
				{
					this.offers[i].SLIDER_COUNT = parseInt(this.offers[i].SLIDER_COUNT);
					if (isNaN(this.offers[i].SLIDER_COUNT))
						this.offers[i].SLIDER_COUNT = 0;
					if (0 === this.offers[i].SLIDER_COUNT)
					{
						this.sliders[i] = {
							COUNT: this.offers[i].SLIDER_COUNT,
							ID: ''
						};
					}
					else
					{
						for (j = 0; j < this.offers[i].SLIDER.length; j++)
						{
							this.offers[i].SLIDER[j].WIDTH = parseInt(this.offers[i].SLIDER[j].WIDTH);
							this.offers[i].SLIDER[j].HEIGHT = parseInt(this.offers[i].SLIDER[j].HEIGHT);
						}
						this.sliders[i] = {
							COUNT: this.offers[i].SLIDER_COUNT,
							OFFER_ID: this.offers[i].ID,
							ID: this.visual.SLIDER_CONT_OF_ID+this.offers[i].ID,
							CONT: BX(this.visual.SLIDER_CONT_OF_ID+this.offers[i].ID),
							LIST: BX(this.visual.SLIDER_LIST_OF_ID+this.offers[i].ID),
							LEFT: BX(this.visual.SLIDER_LEFT_OF_ID+this.offers[i].ID),
							RIGHT: BX(this.visual.SLIDER_RIGHT_OF_ID+this.offers[i].ID),
							START: 0
						};
						SliderImgs = BX.findChildren(this.sliders[i].LIST, {tagName: 'li'}, true);
						if (!!SliderImgs && 0 < SliderImgs.length)
						{
							for (j = 0; j < SliderImgs.length; j++)
							{
								BX.bind(SliderImgs[j], 'click', BX.delegate(this.SelectSliderImg, this));
							}
						}
						if (!!this.sliders[i].LEFT)
							BX.bind(this.sliders[i].LEFT, 'click', BX.delegate(this.SliderRowLeft, this));
						if (!!this.sliders[i].RIGHT)
							BX.bind(this.sliders[i].RIGHT, 'click', BX.delegate(this.SliderRowRight, this));
					}
				}
				this.SetCurrent();
				break;
		}

		if (!!this.obBuyBtn)
			BX.bind(this.obBuyBtn, 'click', BX.delegate(this.Basket, this));
	}
};

window.JCCatalogElement.prototype.ProductSliderRowLeft = function()
{
	var target = BX.proxy_context;
	if (!!target)
	{
		if (5 < this.product.slider.COUNT)
		{
			if (0 > this.product.slider.START)
			{
				this.product.slider.START++;
				BX.adjust(this.product.slider.LIST, { style: { marginLeft: this.product.slider.START*20+'%' }});
			}
		}
	}
};

window.JCCatalogElement.prototype.ProductSliderRowRight = function()
{
	var target = BX.proxy_context;
	if (!!target)
	{
		if (5 < this.product.slider.COUNT)
		{
			if ((5 - this.product.slider.START) < this.product.slider.COUNT)
			{
				this.product.slider.START--;
				BX.adjust(this.product.slider.LIST, { style: { marginLeft: this.product.slider.START*20+'%' }});
			}
		}
	}
};

window.JCCatalogElement.prototype.ProductSelectSliderImg = function()
{
	var target = BX.proxy_context;
	if (!!target && target.hasAttribute('data-value'))
	{
		var strValue = target.getAttribute('data-value');
		this.SetProductMainPict(strValue);
	}
};

window.JCCatalogElement.prototype.SetProductMainPict = function(intPict)
{
	var indexPict = -1;
	var i = 0;
	var j = 0;
	var value = '';
	var strValue = '';

	if (0 < this.product.sliderCount)
	{
		for (j = 0; j < this.product.SLIDER_PICT.length; j++)
		{
			if (intPict == this.product.SLIDER_PICT[j].ID)
			{
				indexPict = j;
				break;
			}
		}
		if (-1 < indexPict)
		{
			if (!!this.obPict && !!this.product.SLIDER_PICT[indexPict])
			{
				BX.adjust(
					this.obPict,
					{
						props: {
							src: this.product.SLIDER_PICT[indexPict].SRC,
							className: ''
						}
					}
				);
			}
			var RowItems = BX.findChildren(this.product.slider.LIST, {tagName: 'li'}, false);
			if (!!RowItems && 0 < RowItems.length)
			{
				strValue = intPict;
				for (i = 0; i < RowItems.length; i++)
				{
					value = RowItems[i].getAttribute('data-value');
					if (value == strValue)
						BX.addClass(RowItems[i], 'bx_active');
					else
						BX.removeClass(RowItems[i], 'bx_active');
				}
			}
		}
	}
};

window.JCCatalogElement.prototype.SliderRowLeft = function()
{
	var target = BX.proxy_context;
	if (!!target && target.hasAttribute('data-value'))
	{
		var strValue = target.getAttribute('data-value');
		var index = -1;
		for (var i = 0; i < this.sliders.length; i++)
		{
			if (this.sliders[i].OFFER_ID == strValue)
			{
				index = i;
				break;
			}
		}
		if (-1 < index && 5 < this.sliders[index].COUNT)
		{
			if (0 > this.sliders[index].START)
			{
				this.sliders[index].START++;
				BX.adjust(this.sliders[index].LIST, { style: { marginLeft: this.sliders[index].START*20+'%' }});
			}
		}
	}
};

window.JCCatalogElement.prototype.SliderRowRight = function()
{
	var target = BX.proxy_context;
	if (!!target && target.hasAttribute('data-value'))
	{
		var strValue = target.getAttribute('data-value');
		var index = -1;
		for (var i = 0; i < this.sliders.length; i++)
		{
			if (this.sliders[i].OFFER_ID == strValue)
			{
				index = i;
				break;
			}
		}
		if (-1 < index && 5 < this.sliders[index].COUNT)
		{
			if ((5 - this.sliders[index].START) < this.sliders[index].COUNT)
			{
				this.sliders[index].START--;
				BX.adjust(this.sliders[index].LIST, { style: { marginLeft: this.sliders[index].START*20+'%' }});
			}
		}
	}
};

window.JCCatalogElement.prototype.SelectSliderImg = function()
{
	var target = BX.proxy_context;
	if (!!target && target.hasAttribute('data-value'))
	{
		var strValue = target.getAttribute('data-value');
		var arItem = strValue.split('_');
		this.SetMainPict(arItem[0], arItem[1]);
	}
};

window.JCCatalogElement.prototype.SetMainPict = function(intSlider, intPict)
{
	var index = -1;
	var indexPict = -1;
	var i = 0;
	var j = 0;
	var value = '';
	for (i = 0; i < this.offers.length; i++)
	{
		if (intSlider == this.offers[i].ID)
		{
			index = i;
			break;
		}
	}
	if (-1 < index)
	{
		if (0 < this.offers[index].SLIDER_COUNT)
		{
			for (j = 0; j < this.offers[index].SLIDER.length; j++)
			{
				if (intPict == this.offers[index].SLIDER[j].ID)
				{
					indexPict = j;
					break;
				}
			}
			if (-1 < indexPict)
			{
				if (!!this.obPict && !!this.offers[index].SLIDER[indexPict])
				{
					BX.adjust(
						this.obPict,
						{
							props: {
								src: this.offers[index].SLIDER[indexPict].SRC,
								className: ''
							}
						}
					);
				}
				var RowItems = BX.findChildren(this.sliders[index].LIST, {tagName: 'li'}, false);
				if (!!RowItems && 0 < RowItems.length)
				{
					var strValue = intSlider+'_'+intPict;
					for (i = 0; i < RowItems.length; i++)
					{
						value = RowItems[i].getAttribute('data-value');
						if (value == strValue)
							BX.addClass(RowItems[i], 'bx_active');
						else
							BX.removeClass(RowItems[i], 'bx_active');
					}
				}
			}
		}
	}
};

window.JCCatalogElement.prototype.SetMainPictFromItem = function(index)
{
	if (!!this.obPict)
	{
		var boolSet = false;
		var obNewPict = {};
		if (!!this.offers[index])
		{
			if (!!this.offers[index].DETAIL_PICTURE)
			{
				obNewPict = this.offers[index].DETAIL_PICTURE;
				boolSet = true;
			}
			else if (!!this.offers[index].PREVIEW_PICTURE)
			{
				obNewPict = this.offers[index].PREVIEW_PICTURE;
				boolSet = true;
			}
		}
		if (!boolSet)
		{
			if (!!this.defaultPict.detail)
			{
				obNewPict = this.defaultPict.detail;
				boolSet = true;
			}
			else if (!!this.defaultPict.preview)
			{
				obNewPict = this.defaultPict.preview;
				boolSet = true;
			}
		}
		if (boolSet)
		{
			BX.adjust(
				this.obPict,
				{
					props: {
						src: obNewPict.SRC,
						className: (obNewPict.WIDTH > obNewPict.HEIGHT ? 'landscape' : 'portrait')
					}
				}
			);
		}
	}
};

window.JCCatalogElement.prototype.QuantityUp = function()
{
	var curValue = 0;
	var boolSet = true;
	if (0 === this.errorCode && this.showQuantity)
	{
		curValue = (
			this.isDblQuantity
			? parseFloat(this.obQuantity.value)
			: parseInt(this.obQuantity.value)
		);
		if (!isNaN(curValue))
		{
			curValue += this.stepQuantity;
			if (this.checkQuantity)
			{
				if (curValue > this.maxQuantity)
					boolSet = false;
			}

			if (boolSet)
			{
				if (this.isDblQuantity)
				{
					curValue = Math.round(curValue*this.precisionFactor)/this.precisionFactor;
				}
				this.obQuantity.value = curValue;
			}
		}
	}
};

window.JCCatalogElement.prototype.QuantityDown = function()
{
	var curValue = 0;
	var boolSet = true;
	if (0 === this.errorCode && this.showQuantity)
	{
		curValue = (
			this.isDblQuantity
			? parseFloat(this.obQuantity.value)
			: parseInt(this.obQuantity.value)
		);
		if (!isNaN(curValue))
		{
			curValue -= this.stepQuantity;
			if (curValue < this.stepQuantity)
				boolSet = false;
			if (boolSet)
			{
				if (this.isDblQuantity)
				{
					curValue = Math.round(curValue*this.precisionFactor)/this.precisionFactor;
				}
				this.obQuantity.value = curValue;
			}
		}
	}
};

window.JCCatalogElement.prototype.QuantityChange = function()
{
	var curValue = 0;
	var boolSet = true;
	if (0 === this.errorCode && this.showQuantity)
	{
		curValue = (
			this.isDblQuantity
			? parseFloat(this.obQuantity.value)
			: parseInt(this.obQuantity.value)
		);
		if (!isNaN(curValue))
		{
			if (this.checkQuantity)
			{
				if (curValue > this.maxQuantity)
				{
					boolSet = false;
					curValue = this.maxQuantity;
				}
				else if (curValue < this.stepQuantity)
				{
					boolSet = false;
					curValue = this.stepQuantity;
				}
			}
			if (!boolSet)
			{
				this.obQuantity.value = curValue;
			}
		}
		else
		{
			this.obQuantity.value = this.stepQuantity;
		}
	}
};

window.JCCatalogElement.prototype.QuantitySet = function(index)
{
	if (0 === this.errorCode)
	{
		this.canBuy = this.offers[index].CAN_BUY;
		if (this.showQuantity)
		{
			this.isDblQuantity = this.offers[index].QUANTITY_FLOAT;
			this.checkQuantity = this.offers[index].CHECK_QUANTITY;
			this.maxQuantity = (this.isDblQuantity
				? parseFloat(this.offers[index].MAX_QUANTITY)
				: parseInt(this.offers[index].MAX_QUANTITY)
			);
			this.stepQuantity = (this.isDblQuantity
				? parseFloat(this.offers[index].STEP_QUANTITY)
				: parseInt(this.offers[index].STEP_QUANTITY)
			);
			if (this.isDblQuantity)
			{
				this.stepQuantity = Math.round(this.stepQuantity*this.precisionFactor)/this.precisionFactor;
			}
			this.obQuantity.value = this.stepQuantity;
			if (!!this.obMeasure)
			{
				if (!!this.offers[index].MEASURE)
				{
					BX.adjust(this.obMeasure, { html : this.offers[index].MEASURE});
				}
				else
				{
					BX.adjust(this.obMeasure, { html : ''});
				}
			}
			if (!!this.obQuantityLimit.all)
			{
				if (!this.checkQuantity)
				{
					BX.adjust(this.obQuantityLimit.value, { html: '' });
					BX.adjust(this.obQuantityLimit.all, { style: {display: 'none'} });
				}
				else
				{
					var strLimit = this.offers[index].MAX_QUANTITY;
					if (!!this.offers[index].MEASURE)
						strLimit += (' '+this.offers[index].MEASURE);
					BX.adjust(this.obQuantityLimit.value, { html: strLimit});
					BX.adjust(this.obQuantityLimit.all, { style: {display: ''} });
				}
			}
		}
	}
};

window.JCCatalogElement.prototype.SelectOfferProp = function()
{
	var i = 0;
	var target = BX.proxy_context;
	if (!!target && target.hasAttribute('data-treevalue'))
	{
		var strTreeValue = target.getAttribute('data-treevalue');
		var arTreeItem = strTreeValue.split('_');
		this.SearchOfferPropIndex(arTreeItem[0], arTreeItem[1]);
		var RowItems = BX.findChildren(target.parentNode, {tagName: 'li'}, false);
		if (!!RowItems && 0 < RowItems.length)
		{
			for (i = 0; i < RowItems.length; i++)
			{
				BX.removeClass(RowItems[i], 'bx_active');
			}
		}
		BX.addClass(target, 'bx_active');
	}
};

window.JCCatalogElement.prototype.SearchOfferPropIndex = function(strPropID, strPropValue)
{
	var strName = '';
	var arShowValues = false;
	var arCanBuyValues = [];
	var index = -1;
	for (var i = 0; i < this.treeProps.length; i++)
	{
		if (this.treeProps[i].ID == strPropID)
		{
			index = i;
			break;
		}
	}

	if (-1 < index)
	{
		var arFilter = {};
		for (i = 0; i < index; i++)
		{
			strName = 'PROP_'+this.treeProps[i].ID;
			arFilter[strName] = this.selectedValues[strName];
		}
		strName = 'PROP_'+this.treeProps[index].ID;
		arFilter[strName] = strPropValue;
		for (i = index+1; i < this.treeProps.length; i++)
		{
			strName = 'PROP_'+this.treeProps[i].ID;
			arShowValues = this.GetRowValues(arFilter, strName);
			if (!arShowValues)
				break;
			if (this.showAbsent)
			{
				arCanBuyValues = [];
				var tmpFilter = [];
				tmpFilter = BX.clone(arFilter, true);
				for (var j = 0; j < arShowValues.length; j++)
				{
					tmpFilter[strName] = arShowValues[j];
					if (this.GetCanBuy(tmpFilter))
						arCanBuyValues[arCanBuyValues.length] = arShowValues[j];
				}
			}
			else
			{
				arCanBuyValues = arShowValues;
			}
			if (!!this.selectedValues[strName] && BX.util.in_array(this.selectedValues[strName], arCanBuyValues))
				arFilter[strName] = this.selectedValues[strName];
			else
				arFilter[strName] = arCanBuyValues[0];
			this.UpdateRow(i, arFilter[strName], arShowValues, arCanBuyValues);
		}
		this.selectedValues = arFilter;
		this.ChangeInfo();
	}
};

window.JCCatalogElement.prototype.RowLeft = function()
{
	var target = BX.proxy_context;
	if (!!target && target.hasAttribute('data-treevalue'))
	{
		var strTreeValue = target.getAttribute('data-treevalue');
		var index = -1;
		for (var i = 0; i < this.treeProps.length; i++)
		{
			if (this.treeProps[i].ID == strTreeValue)
			{
				index = i;
				break;
			}
		}
		if (-1 < index && 5 < this.showCount[index])
		{
			if (0 > this.showStart[index])
			{
				this.showStart[index]++;
				BX.adjust(this.obTreeRows[index].LIST, { style: { marginLeft: this.showStart[index]*20+'%' }});
			}
		}
	}
};

window.JCCatalogElement.prototype.RowRight = function()
{
	var target = BX.proxy_context;
	if (!!target && target.hasAttribute('data-treevalue'))
	{
		var strTreeValue = target.getAttribute('data-treevalue');
		var index = -1;
		for (var i = 0; i < this.treeProps.length; i++)
		{
			if (this.treeProps[i].ID == strTreeValue)
			{
				index = i;
				break;
			}
		}
		if (-1 < index && 5 < this.showCount[index])
		{
			if ((5 - this.showStart[index]) < this.showCount[index])
			{
				this.showStart[index]--;
				BX.adjust(this.obTreeRows[index].LIST, { style: { marginLeft: this.showStart[index]*20+'%' }});
			}
		}
	}
};

window.JCCatalogElement.prototype.UpdateRow = function(intNumber, activeID, showID, canBuyID)
{
	var i = 0;
	var value = '';
	var countShow = 0;
	var strNewLen = '';
	var obData = {};
	if (-1 < intNumber && intNumber < this.obTreeRows.length)
	{
		var RowItems = BX.findChildren(this.obTreeRows[intNumber].LIST, {tagName: 'li'}, false);
		if (!!RowItems && 0 < RowItems.length)
		{
			countShow = showID.length;
			strNewLen = (5 < countShow ? (100/countShow)+'%' : '20%');
			obData = {
				props: { className: '' },
				style: {
					width: strNewLen
				}
			};
			if ('E' == this.treeProps[intNumber].TYPE)
				obData.style.paddingTop = strNewLen;
			for (i = 0; i < RowItems.length; i++)
			{
				value = RowItems[i].getAttribute('data-onevalue');
				if (BX.util.in_array(value, canBuyID))
				{
					if (value == activeID)
						obData.props.className = 'bx_active';
					else
						obData.props.className = '';
				}
				else
				{
					if (value == activeID)
						obData.props.className = 'bx_active bx_missing';
					else
						obData.props.className = 'bx_missing';
				}
				if (BX.util.in_array(value, showID))
					obData.style.display = '';
				else
					obData.style.display = 'none';
				BX.adjust(RowItems[i], obData);
			}
			obData = {
				style: {
					width: (5 < countShow ? 20*countShow : 100)+'%',
					marginLeft: '0%'
				}
			};
			BX.adjust(this.obTreeRows[intNumber].LIST, obData);
			if ('E' == this.treeProps[intNumber].TYPE)
				BX.adjust(this.obTreeRows[intNumber].CONT, {props: {className: (5 < countShow ? 'bx_item_detail_scu full' : 'bx_item_detail_scu')}});
			else
				BX.adjust(this.obTreeRows[intNumber].CONT, {props: {className: (5 < countShow ? 'bx_item_detail_size full' : 'bx_item_detail_size')}});
			if (5 < countShow)
			{
				BX.adjust(this.obTreeRows[intNumber].LEFT, {style: {display: ''}});
				BX.adjust(this.obTreeRows[intNumber].RIGHT, {style: {display: ''}});
			}
			else
			{
				BX.adjust(this.obTreeRows[intNumber].LEFT, {style: {display: 'none'}});
				BX.adjust(this.obTreeRows[intNumber].RIGHT, {style: {display: 'none'}});
			}
			this.showCount[intNumber] = countShow;
			this.showStart[intNumber] = 0;
		}
	}
};

window.JCCatalogElement.prototype.GetRowValues = function(arFilter, index)
{
	var arValues = [];
	var i = 0;
	var j = 0;
	var boolSearch = false;
	if (0 === arFilter.length)
	{
		for (i = 0; i < this.offers.length; i++)
		{
			if (!BX.util.in_array(this.offers[i].TREE[index], arValues))
				arValues[arValues.length] = this.offers[i].TREE[index];
		}
		boolSearch = true;
	}
	else
	{
		for (i = 0; i < this.offers.length; i++)
		{
			var boolOneSearch = true;
			for (j in arFilter)
			{
				if (arFilter[j] != this.offers[i].TREE[j])
				{
					boolOneSearch = false;
					break;
				}
			}
			if (boolOneSearch)
			{
				if (!BX.util.in_array(this.offers[i].TREE[index], arValues))
					arValues[arValues.length] = this.offers[i].TREE[index];
				boolSearch = true;
			}
		}
	}
	return (boolSearch ? arValues : false);
};

window.JCCatalogElement.prototype.GetCanBuy = function(arFilter)
{
	var i = 0;
	var j = 0;
	var boolOneSearch = true;
	var boolSearch = false;
	for (i = 0; i < this.offers.length; i++)
	{
		boolOneSearch = true;
		for (j in arFilter)
		{
			if (arFilter[j] != this.offers[i].TREE[j])
			{
				boolOneSearch = false;
				break;
			}
		}
		if (boolOneSearch)
		{
			if (this.offers[i].CAN_BUY)
			{
				boolSearch = true;
				break;
			}
		}
	}
	return boolSearch;
};

window.JCCatalogElement.prototype.SetCurrent = function()
{
	var i = 0;
	var j = 0;
	var strName = '';
	var arShowValues = false;
	var arCanBuyValues = [];
	var arFilter = {};
	var current = this.offers[this.offerNum].TREE;
	for (i = 0; i < this.treeProps.length; i++)
	{
		strName = 'PROP_'+this.treeProps[i].ID;
		arShowValues = this.GetRowValues(arFilter, strName);
		if (!arShowValues)
			break;
		if (BX.util.in_array(current[strName], arShowValues))
		{
			arFilter[strName] = current[strName];
		}
		else
		{
			arFilter[strName] = arShowValues[0];
			this.offerNum = 0;
		}
		if (this.showAbsent)
		{
			arCanBuyValues = [];
			var tmpFilter = [];
			tmpFilter = BX.clone(arFilter, true);
			for (j = 0; j < arShowValues.length; j++)
			{
				tmpFilter[strName] = arShowValues[j];
				if (this.GetCanBuy(tmpFilter))
					arCanBuyValues[arCanBuyValues.length] = arShowValues[j];
			}
		}
		else
		{
			arCanBuyValues = arShowValues;
		}
		this.UpdateRow(i, arFilter[strName], arShowValues, arCanBuyValues);
	}
	this.selectedValues = arFilter;
	this.ChangeInfo();
};

window.JCCatalogElement.prototype.ChangeInfo = function()
{
	var index = -1;
	var i = 0;
	var j = 0;
	var boolOneSearch = true;
	for (i = 0; i < this.offers.length; i++)
	{
		boolOneSearch = true;
		for (j in this.selectedValues)
		{
			if (this.selectedValues[j] != this.offers[i].TREE[j])
			{
				boolOneSearch = false;
				break;
			}
		}
		if (boolOneSearch)
		{
			index = i;
			break;
		}
	}
	if (-1 < index)
	{
		if (!!this.obPrice.price)
		{
			BX.adjust(this.obPrice.price, {html: this.offers[index].PRICE.PRINT_DISCOUNT_VALUE});
			if (this.offers[index].PRICE.DISCOUNT_VALUE != this.offers[index].PRICE.VALUE)
			{
				if (this.showOldPrice)
				{
					if (!!this.obPrice.full)
						BX.adjust(this.obPrice.full, {style: {display: ''}, html: this.offers[index].PRICE.PRINT_VALUE});
					if (!!this.obPrice.discount)
						BX.adjust(this.obPrice.discount, {style: {display: ''}, html: this.offers[index].PRICE.PRINT_DISCOUNT_DIFF});
				}
				if (this.showPercent)
				{
					if (!!this.obPrice.percent)
						BX.adjust(this.obPrice.percent, {style: {display: ''}, html: this.offers[index].PRICE.DISCOUNT_DIFF_PERCENT+'%'});
				}
			}
			else
			{
				if (this.showOldPrice)
				{
					if (!!this.obPrice.full)
						BX.adjust(this.obPrice.full, {style: {display: 'none'}, html: ''});
					if (!!this.obPrice.discount)
						BX.adjust(this.obPrice.discount, {style: {display: 'none'}, html: ''});
				}
				if (this.showPercent)
				{
					if (!!this.obPrice.percent)
						BX.adjust(this.obPrice.percent, {style: {display: 'none'}, html: ''});
				}
			}
		}
		for (i = 0; i < this.offers.length; i++)
		{
			if (this.showOfferGroup && this.offers[i].OFFER_GROUP)
			{
				if (i != index)
				{
					BX.adjust(BX(this.visual.OFFER_GROUP+this.offers[i].ID), { style: {display: 'none'} });
				}
			}
			if ('' === this.sliders[i].ID)
				continue;
			if (i == index)
			{
				this.sliders[i].START = 0;
				BX.adjust(this.sliders[i].LIST, {style: { marginLeft: '0%' }});
				BX.adjust(this.sliders[i].CONT, {style: { display: ''}});
			}
			else
			{
				BX.adjust(this.sliders[i].CONT, {style: { display: 'none'}});
			}
		}
		if (this.showOfferGroup && this.offers[index].OFFER_GROUP)
		{
			BX.adjust(BX(this.visual.OFFER_GROUP+this.offers[index].ID), { style: {display: ''} });
		}
		if (0 < this.offers[index].SLIDER_COUNT)
		{
			this.SetMainPict(this.offers[index].ID, this.offers[index].SLIDER[0].ID);
		}
		else
		{
			this.SetMainPictFromItem(index);
		}
		if (this.showSkuProps && !!this.obSkuProps)
		{
			if (0 === this.offers[index].DISPLAY_PROPERTIES.length)
			{
				BX.adjust(this.obSkuProps, {style: {display: 'none'}, html: ''});
			}
			else
			{
				BX.adjust(this.obSkuProps, {style: {display: ''}, html: this.offers[index].DISPLAY_PROPERTIES});
			}
		}
		this.offerNum = index;
		if (this.showQuantity)
		{
			this.QuantitySet(this.offerNum);
		}
		BX.onCustomEvent('onCatalogStoreProductChange', [this.offers[this.offerNum].ID]);
	}
};

window.JCCatalogElement.prototype.Basket = function()
{
	if (!this.canBuy)
		return;
	var strBasket = '';
	switch (this.productType)
	{
	case 1://product
	case 2://set
		strBasket = this.product.buyUrl;
		if (this.showQuantity)
			strBasket += '&'+this.basketData.quantity+'='+this.obQuantity.value;
		location.href=strBasket;
		break;
	case 3://sku
		strBasket = this.offers[this.offerNum].BUY_URL;
		if (this.showQuantity)
			strBasket += '&'+this.basketData.quantity+'='+this.obQuantity.value;
		location.href=strBasket;
		break;
	default:
		return;
	}
};

window.JCCatalogElement.prototype.ShowBasketPopup = function(arResult)
{
	var strContent = '';
	var strName = '';
	var strPict = '';
	if ('object' == typeof(arResult))
	{
		if ('OK' == arResult.STATUS)
		{
			switch(this.productType)
			{
			case 1://product
			case 2://set
				strName = this.product.name;
				strPict = this.product.pict.SRC;
				break;
			case 3://sku
				strName = this.offers[this.offerNum].NAME;
				strPict = this.offers[this.offerNum].PICT.SRC;
				break;
			}
			strContent = '<p>'+BX.message('ADD_TO_BASKET_OK')+'</p>';
			strContent += '<img src="'+strPict+'" height="130"><p>'+strName+'</p>';
		}
		else
		{

		}
	}
	else
	{

	}
	var popup = BX.PopupWindowManager.create('CatalogSectionBasket'+this.visual.ID, null, {
		autoHide: false,
		offsetLeft: 0,
		offsetTop: 0,
		overlay : true,
		draggable: {restrict:true},
		closeByEsc: true,
		closeIcon: { right : "12px", top : "10px"},
		content: '' +
			'<div style="width:300px;text-align: center;padding-top:5px; margin-bottom: 10px;">' +
			strContent+
			'<a class="bx_bt_blue bx_medium" href="'+BX.message("setButtonBuyUrl")+'"><span class="bx_icon_cart"></span><span>'+BX.message("setButtonBuyName")+'</span></a>'+
			'</div>'
		});

	popup.show();
};
})(window);