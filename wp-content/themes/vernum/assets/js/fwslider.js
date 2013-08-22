function fwslider(){
    var glob = {
        cs : 0,
        pause: 6000,
        duration: 750
    }
    
    this.init = function(params){
        
        if (params.duration) {
            glob.duration = parseInt(params.duration,10);
        }
        
        if (params.pause) {
            glob.pause = parseInt(params.pause,10);
        }
        
        /* Init */
        content.init();
        display.bindControls();
        controls.bindControls();
    }
    
    var display = {
        /* Resize function */
        resize: function(){
            jQuery("#fwslider").css({height: jQuery("#fwslider .slide").height()});
            controls.position();
        },
        
        /* Bind resize listener */
        bindControls: function(){
            jQuery(window).resize(function(){
                display.resize()
            });
        }
    }
    
    var controls = {
        /* Adjust buttons position */
        position: function(){
            jQuery("#fwslider .slidePrev, #fwslider .slideNext").css({
                top: jQuery("#fwslider").height() / 2 - jQuery("#fwslider .slideNext").height() / 2
            });
            
            jQuery("#fwslider .slidePrev").css({left:0});
            jQuery("#fwslider .slideNext").css({right:0});
        },
        
        /* Bind button controls */
        bindControls : function(){
            
            /* Hover effect */
            jQuery("#fwslider .slidePrev, #fwslider .slideNext").on("mouseover", function(){
                jQuery(this).animate({
                    opacity:1
                },{
                    queue:false, 
                    duration:1000,
                    easing:"easeOutCubic"
                });
            });
            
            /* Hover effect - mouseout */
            jQuery("#fwslider .slidePrev, #fwslider .slideNext").on("mouseout", function(){
                jQuery(this).animate({
                    opacity:0.5
                },{
                    queue:false, 
                    duration:1000,
                    easing:"easeOutCubic"
                });
            });
            
            /* Next Button */
            jQuery("#fwslider .slideNext").on("click", function(){
                if (jQuery("#fwslider .slide").is(":animated")) return; 
                
                if (jQuery("#fwslider .slide:eq("+(glob.cs+1)+")").length <= 0) {
                    glob.cs = 0;
                    
                    jQuery("#fwslider .timers .timer .progress").stop();
                    
                    jQuery("#fwslider .timers .timer:last .progress").animate({
                        width:"100%"
                    },{
                        queue:false,
                        duration:glob.duration,
                        easing:"easeOutCubic",
                        complete: function(){
                            jQuery("#fwslider .timers .timer .progress").css({
                                width:"0%"
                            });
                        }
                    });
                } else {
                    glob.cs++;
                    
                    jQuery("#fwslider .timers .timer .progress").stop();
                    jQuery("#fwslider .timers .timer:lt("+glob.cs+") .progress").animate({
                        width:"100%"
                    },{
                        queue:false,
                        duration:glob.duration,
                        easing:"easeOutCubic"
                    });
                    
                }
                content.show();
            });
            
            /* Previous Button */
            jQuery("#fwslider .slidePrev").on("click", function(){
                if (jQuery("#fwslider .slide").is(":animated")) return; 
                
                if (glob.cs <= 0) {
                    glob.cs = jQuery("#fwslider .slide").index();
                    
                    jQuery("#fwslider .timers .timer .progress").stop();
                    jQuery("#fwslider .timers .timer .progress").css({
                        width:"100%"
                    });
                     jQuery("#fwslider .timers .timer:last .progress").animate({
                        width:"0%"
                    },{
                        queue:false,
                        duration:glob.duration,
                        easing:"easeOutCubic"
                    });
                    
                } else {
                    glob.cs--;
                    
                    jQuery("#fwslider .timers .timer .progress").stop();
                    jQuery("#fwslider .timers .timer:gt("+glob.cs+") .progress").css({
                        width:"0%"
                    });
                    jQuery("#fwslider .timers .timer:eq("+glob.cs+") .progress").animate({
                        width:"0%"
                    },{
                        queue:false,
                        duration:glob.duration,
                        easing:"easeOutCubic"
                    });
                }
                content.show();
            });
        }
    }
    
    var content = {
        init: function(){
            /* First run content adjustment */
            
            for (var i = 0; i < jQuery("#fwslider .slide").length; i++){
                jQuery('<div class="timer"><div class="progress"></div></div>').appendTo("#fwslider .timers");
            }
            
            jQuery("#fwslider .timers").css({
                width: (jQuery("#fwslider .timers .timer").length + 1) * 45
            });
            
            jQuery("#fwslider .slide:eq("+glob.cs+")").fadeIn({
                duration:500, 
                easing: "swing"
            });
            
            jQuery("#fwslider").animate({
                height: jQuery("#fwslider .slide:first img").height()
            },{
                queue:false,
                duration:500, 
                easing: "easeInOutExpo", 
                complete: function(){
                    jQuery("#fwslider .slidePrev").animate({
                        left:0
                    },{
                        queue:false,
                        duration:0, 
                        easing:"easeOutCubic"
                    });
                    
                    jQuery("#fwslider .slideNext").animate({
                        right:0
                    },{
                        queue:false,
                        duration:0, 
                        easing:"easeOutCubic"
                    });
                    
                    content.showText();
                    controls.position();
                    display.resize();
                    auto.run();
                    auto.focus();
                }
            });
        },
        
        show: function(){
            /* Show slide */
            
            content.hideText();
            
            jQuery("#fwslider .slide:eq("+glob.cs+")").css({
                opacity:0,
                zIndex:2
            }).show().animate({
                opacity:1
            },{
                queue:false,
                duration: glob.duration, 
                easing: "swing", 
                complete: function(){
                    jQuery("#fwslider .slide:lt("+glob.cs+"), #fwslider .slide:gt("+glob.cs+")").css({
                        zIndex:0
                    }).hide();
                   
                    jQuery("#fwslider .slide:eq("+glob.cs+")").css({
                        zIndex:1
                    });
                    content.showText();
                    auto.run();
                }
            });
        },
        
        showText: function(){
            /* Show slide text */
            
             jQuery("#fwslider .slide:eq("+glob.cs+") .title").animate({
                opacity:1
            },{
                queue:false,
                duration:300,
                easing:"swing"
            });
            
            setTimeout(function(){
                jQuery("#fwslider .slide:eq("+glob.cs+") .description").animate({
                    opacity:1
                },{
                    queue:false,
                    duration:300,
                    easing:"swing"
                });
            },150)
            
            setTimeout(function(){
                jQuery("#fwslider .slide:eq("+glob.cs+") .readmore").animate({
                    opacity:1
                },{
                    queue:false,
                    duration:300,
                    easing:"swing"
                });
            },300)
            
            
        },
        hideText: function(){
            /* Hide slide text */
            
            jQuery("#fwslider .slide .title").animate({
                opacity:0
            },{
                queue:false,
                duration:300,
                easing:"swing"
            });
            
            setTimeout(function(){
                jQuery("#fwslider .slide .description").animate({
                    opacity:0
                },{
                    queue:false,
                    duration:300,
                    easing:"swing"
                });
            },150)
            
            setTimeout(function(){
                jQuery("#fwslider .slide .readmore").animate({
                    opacity:0
                },{
                    queue:false,
                    duration:300,
                    easing:"swing"
                });
            },300)
            
            
        }
    }
    
    var auto = {
        /* Run timer */
        run: function(){
            jQuery("#fwslider .timer:eq("+glob.cs+") .progress").animate({
                width:"100%" 
            },{
                queue:false,
                duration: (glob.pause - (glob.pause/100)*(((jQuery("#fwslider .timer:eq("+glob.cs+") .progress").width() / jQuery("#fwslider .timer:eq("+glob.cs+")").width()) * 100))), 
                easing:"linear", 
                complete: function(){
                    jQuery("#fwslider .slideNext").trigger("click");
                }
            });
        },
        
        /* Stop on focus */
        focus: function(){
            jQuery("#fwslider .slide_content").on("mouseover", function(){
                if (jQuery("#fwslider .slide").is(":animated")) return;
                jQuery("#fwslider .timer .progress").stop();
            });
            
            jQuery("#fwslider .slide_content").on("mouseleave", function(){
                if (jQuery("#fwslider .slide").is(":animated")) return;
                auto.run();
            });
        }
		
    }
}