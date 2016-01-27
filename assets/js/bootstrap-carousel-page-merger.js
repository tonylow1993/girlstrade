/***
 * This class will transform your single-page bootstrap carousel to a multi-paged bootstrap carousel.
 * It automatically calculates the space a single item requires so it tries to "fill" all the space
 * you offer.
 *
 * I wrote this little helper since the solutions I found in the interwebz was not what I wanted
 * Mostly inspired by this post: http://stackoverflow.com/questions/20007610/bootstrap-3-carousel-multiple-frames-at-once
 *
 * To make the script work, you have to add a new <div> wrapper with the class .item-content
 * directly into your .item <div>. Example:
 *
 * <div class="carousel slide multiple" id="very-cool-carousel" data-ride="carousel">
 *     <div class="carousel-inner" role="listbox">
 *         <div class="item active">
 *           <div class="item-content">
 *             First page
 *           </div>
 *         </div>
 *         <div class="item active">
 *           <div class="item-content">
 *             Second page
 *           </div>
 *         </div>
 *     </div>
 * </div>
 *
 * Usage of this library:
 *
 * var carouselPageMerger = new SocialbitBootstrapCarouselPageMerger();
 * carouselPageMerger.run('div.carousel');
 *
 * To change the settings:
 *
 * var carouselPageMerger = new SocialbitBootstrapCarouselPageMerger();
 *
 * carouselPageMerger.setSettings
 * ({
 *     spaceCalculationFactor: 1.00,
 *     useWidthOfFirstElement: true
 * });
 *
 * carouselPageMerger.run('div.carousel');
 *
 * @author Thomas Kekeisen, Socialbit GmbH, http://socialbit.de
 */
// Singleton helper
var SharedSocialbitBootstrapCarouselPageResizeMerger = (function ()
{
    var instance;

    function createInstance()
    {
        return new SocialbitBootstrapCarouselPageResizeMerger();
    }

    return {
        sharedInstance: function ()
        {
            if (!instance)
            {
                instance = createInstance();
            }

            return instance;
        }
    };
})();

// Class SocialbitBootstrapCarouselPageResizeMerger
function SocialbitBootstrapCarouselPageResizeMerger()
{
    // Private
    var instance                = false;

    // Public
    this.attached               = false;
    this.delegates              = [];
    this.resizedTimer           = null;
    this.watchWindowSizeTimeout = 100;
}

SocialbitBootstrapCarouselPageResizeMerger.prototype.addDelegate = function (delegate)
{
    this.delegates.push(delegate);
};

SocialbitBootstrapCarouselPageResizeMerger.prototype.attach = function (watchWindowSizeTimeout)
{
    var self = SharedSocialbitBootstrapCarouselPageResizeMerger.sharedInstance();

    this.watchWindowSizeTimeout = watchWindowSizeTimeout;

    if (!this.attached)
    {
        $(window).resize(function()
        {
            self.resized(self);
        });
    }
};

SocialbitBootstrapCarouselPageResizeMerger.prototype.resized = function ()
{
    var self = SharedSocialbitBootstrapCarouselPageResizeMerger.sharedInstance();

    if (self.resizedTimer != null)
    {
        window.clearTimeout(self.resizedTimer);

        self.resizedTimer = null;
    }

    self.setUpTimer();
};

SocialbitBootstrapCarouselPageResizeMerger.prototype.resizedTimeout = function()
{
    var self = SharedSocialbitBootstrapCarouselPageResizeMerger.sharedInstance();

    self.resizedTimer = null;

    this.delegates.forEach(function(delegate)
    {
        delegate.resized();
    });
};

SocialbitBootstrapCarouselPageResizeMerger.prototype.setUpTimer = function ()
{
    var self = SharedSocialbitBootstrapCarouselPageResizeMerger.sharedInstance();

    self.resizedTimer = window.setTimeout(function ()
    {
        var self = SharedSocialbitBootstrapCarouselPageResizeMerger.sharedInstance();

        self.resizedTimeout();
    }, self.watchWindowSizeTimeout);
};

// Class SocialbitBootstrapCarouselPageMerger
function SocialbitBootstrapCarouselPageMerger()
{
    // Private
    var defaultSettings =
    {
        // The class name this script uses to find the carousels it has to process later
        className:               "socialbitBootstrapCarouselPageMerger",
        classNameImageSizeKnown: "initial-size-known",

        // Tells the script to also include margin into the calculation
        considerMargin:          true,

        // Turns debug output on and off
        debug:                   false,

        // Animation interval
        interval:                5000,

        // Tells the script how many percent of the available space should be used for the calculation
        // Use something under 1.00 if you want the paging arrows to appear next to your content
        spaceCalculationFactor:  0.76,

        // Tells the script to use the width of the first element in the section
        useWidthOfFirstElement:  false,

        // Determines whether the script should wait for images that may be loaded slower than expected
        waitForImages:           true,

        // The time the script waits between the item width checks
        waitForImagesInterval:   100,

        // Tells the script to recalculate the slider pages when the window size changes
        watchWindowSize:         true,

        // Tells the script how long it has to wait until it recalculates the views
        // Without this delay the carousels would be redrawed too often
        watchWindowSizeTimeout:  250
    };

    // Public
    this.firstElementWidth = null;
    this.initialized       = null;
    this.selector          = null;
    this.settings          = JSON.parse(JSON.stringify(defaultSettings));
};

SocialbitBootstrapCarouselPageMerger.prototype.debug = function (text)
{
    var self = this;

    if (self.settings.debug)
    {
        console.log('socialbitBootstrapCarouselPageMerger: ' + text);
    }
};

SocialbitBootstrapCarouselPageMerger.prototype.generateItems = function (carousel)
{
    var self           = this;
    var carouselId     = carousel.attr('id');
    var widthAvailable = carousel.width() * self.settings.spaceCalculationFactor;
    var itemContents   = carousel.find('.item-content');
    var itemsOld       = carousel.find('.item');
    var newItem        = self.getNewItem(true);
    var newItemWidth   = 0;

    self.debug('Factor: ' + self.settings.spaceCalculationFactor);
    self.debug('Generating items for ' + carouselId + ', width available: ' + widthAvailable + ', items: ' + itemContents.length);

    carousel.addClass(self.settings.classNameImageSizeKnown);

    while (itemContents.length > 0)
    {
        self.debug('Item iteration for ' + carouselId + ', items: ' + itemContents.length);

        var currentItemContent      = itemContents[0];
        var currentItemContentWidth = parseInt($(currentItemContent).attr('initial-width'));

        if (self.settings.useWidthOfFirstElement)
        {
            if (self.firstElementWidth == null)
            {
                self.firstElementWidth = currentItemContentWidth;
            }
            else
            {
                currentItemContentWidth = self.firstElementWidth;
            }
        }

        if (newItemWidth + currentItemContentWidth > widthAvailable)
        {
            carousel.find('.carousel-inner').append(newItem);
            newItem = self.getNewItem();
            newItemWidth = 0;

            self.debug('> Finished a merged item for ' + carouselId);
        }

        newItem.append(currentItemContent);
        newItemWidth += currentItemContentWidth;
        self.debug('Merged two items for ' + carouselId + ', width: ' + currentItemContentWidth + ', size now: ' + newItemWidth + '/' + widthAvailable);

        itemContents.splice(0, 1);
    }

    var childrenCount = newItem.children().length;

    self.debug('Finished iteration, childs left: ' + childrenCount);

    if (childrenCount > 0)
    {
        carousel.find('.carousel-inner').append(newItem);
        newItem = self.getNewItem();
        newItemWidth = 0;

        self.debug('> Finished a merged item for ' + carouselId);
    }

    itemsOld.remove();
    carousel.carousel({
        interval: self.settings.interval
    });

    self.updateIndicators(carousel);
};

SocialbitBootstrapCarouselPageMerger.prototype.initialize = function()
{
    var self = this;

    if (!self.initialized)
    {
        self.initialized = true;

        var resizeManager = SharedSocialbitBootstrapCarouselPageResizeMerger.sharedInstance();

        if (self.settings.watchWindowSize)
        {
            resizeManager.attach
            (
                self.settings.watchWindowSizeTimeout
            );
        }

        resizeManager.addDelegate(self);
    }
};

SocialbitBootstrapCarouselPageMerger.prototype.initialized = false;

SocialbitBootstrapCarouselPageMerger.prototype.getNewItem = function (isActive)
{
    return $('<div></div>').addClass('item ' + (isActive ? 'active' : ''));
};

SocialbitBootstrapCarouselPageMerger.prototype.resized = function ()
{
    var self = this;

    self.debug('Window resized');

    self.run(self.selector, true);
};

SocialbitBootstrapCarouselPageMerger.prototype.run = function (selector, resize)
{
    var self = this;

    if (!self.selector)
    {
        self.selector = selector;
    }

    self.initialize();

    self.debug('Called for selector ' + selector);

    $(selector).each(function()
    {
        var carousel     = $(this);
        var carouselId   = carousel.attr('id');
        var itemContents = carousel.find('.item-content');

        self.debug('Processing carousel ' + carouselId);

        if (!carousel.hasClass('carousel'))
        {
            self.debug('Warning, no .carousel class found for ' + carouselId);
        }

        carousel.addClass(self.settings.className);

        itemContents.each(function()
        {
            var currentItemContent      = $(this);
            var currentItemContentWidth = currentItemContent.width();
            var currentItemInitialWidth = parseInt(currentItemContent.attr('initial-width'));

            if (!resize || currentItemInitialWidth == 0)
            {
                currentItemContent.attr('initial-width', currentItemContentWidth);

                self.debug('Settings initial width to: ' + currentItemContentWidth + ' for ' + carouselId);
            }

            if (self.settings.waitForImages)
            {
                currentItemContent
                    .find('img')
                        .each(function()
                        {
                            var currentImage = $(this);

                            currentImage.load(function()
                            {
                                var image              = $(this);
                                var currentItemContent = image.parents('.item-content');

                                var width = Math.max(currentItemContent.width(), image[0].width);

                                if (self.settings.considerMargin)
                                {
                                    width += parseInt(currentItemContent.css('margin-left')) + parseInt(currentItemContent.css('margin-right'));
                                }

                                self.debug('Found content width ' + width + ' for ' + carouselId);

                                currentItemContent.attr('initial-width', width);
                            });
                        });
            }
        });

        self.waitForContentWidthMeasuring(carousel);
    });
};

SocialbitBootstrapCarouselPageMerger.prototype.setSettings = function (newSettings)
{
    jQuery.extend(this.settings, newSettings);
};

SocialbitBootstrapCarouselPageMerger.prototype.updateIndicators = function (carousel)
{
    var self = this;
    var carouselId     = carousel.attr('id');

    var pages = carousel.find('.carousel-inner .item');
    var pageCount = pages.length;

    var indicators = carousel.find('.carousel-indicators li');
    var indicatorCount = indicators.length;

    self.debug('Found ' + pageCount + ' pages and ' + indicatorCount + ' indicators for ' + carouselId);

    indicators.hide();
    if (pageCount > 1)
    {
        indicators.slice(0, pageCount).show();
    }
};

SocialbitBootstrapCarouselPageMerger.prototype.waitForContentWidthMeasuring = function (carousel)
{
    var self = this;

    if (carousel.hasClass(self.settings.classNameImageSizeKnown))
    {
        self.debug('Skipping to item generation since content sizes are already known for ' + carouselId);

        self.generateItems(carousel);
    }
    else
    {
        var carouselId = carousel.attr('id');

        if (!self.settings.waitForImages)
        {
            self.debug('Skipping to item generation since image waiting is disabled for ' + carouselId);

            self.generateItems(carousel);
        }
        else
        {
            var itemContents        = carousel.find('.item-content');
            var initialWidthMissing = false;

            if (itemContents.length == 0)
            {
                self.debug('Warning, no .item-content available for ' + carouselId);
            }

            itemContents.each(function()
            {
                var currentItemContent      = $(this);
                var currentItemContentWidth = parseInt(currentItemContent.attr('initial-width'));

                if (currentItemContentWidth == 0)
                {
                    self.debug('Found missing width, waiting ' + self.settings.waitForImagesInterval + 'ms for ' + carouselId);

                    window.setTimeout(function()
                    {
                        self.waitForContentWidthMeasuring(carousel);
                    }, self.settings.waitForImagesInterval);

                    initialWidthMissing = true;

                    return false;
                }
            });

            if (!initialWidthMissing)
            {
                self.debug('Finished waiting, all images should be loaded for ' + carouselId);

                self.generateItems(carousel);
            }
        }
    }
};