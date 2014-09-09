(function(){
  var cos, sin, floor;
  cos = Math.cos;
  sin = Math.sin;
  floor = Math.floor;
  $.fn.paraspin = function(opt, oo){
    var plot, i$, to$, n, this$ = this;
    plot = function(o){
      return function(){
        var t, i$, to$, n, pos, results$ = [];
        t = new Date().getTime();
        for (i$ = 0, to$ = o.amount; i$ < to$; ++i$) {
          n = i$;
          pos = o.shape(o, o.radius, o.speed * t / 1000, n / o.amount);
          results$.push($(this$).find(".load-circle-" + n).css({
            left: o.x0 + pos.x - pos.width / 2,
            top: o.y0 + pos.y - pos.height / 2,
            width: pos.width || o.size,
            height: pos.height || o.size
          }));
        }
        return results$;
      };
    };
    switch (opt) {
    case 'stop':
      clearInterval($(this).data('load-int'));
      return $(this).data('load-int', "");
    case 'start':
      if ($(this).data('load-int')) {
        return;
      }
      return $(this).data('load-int', setInterval(plot($(this).data('load-opts')), 16));
    default:
      opt = $.extend({
        size: 10,
        radius: 60,
        amount: 8,
        speed: -0.5,
        shape: function(o, r, t, n){
          return {
            x: r * (cos((t + n) * 7 / 2 * Math.PI) + sin((t + n) * 2 * Math.PI)),
            y: r * sin((t + n) * 1.25 * Math.PI),
            width: (r - r * n) / 3,
            height: (r - r * n) / 3
          };
        },
        x0: $(this).width() / 2,
        y0: $(this).height() / 2
      }, opt);
      $(this).data('load-opts', opt);
      $(this).css('position', 'relative');
      for (i$ = 0, to$ = opt.amount; i$ < to$; ++i$) {
        n = i$;
        $("<div class=\"load-circle load-circle-" + n + "\"></div>").appendTo($(this)).css({
          width: opt.size,
          height: opt.size,
          top: opt.x0,
          left: opt.y0
        });
      }
      return $(this).data('load-int', setInterval(plot(opt), 16));
    }
  };
  $('.innerpoop').paraspin({
    shape: function(o, r, t, n){
      return {
        x: (1 - n) * r * Math.pow(sin((t + n) * 3 * Math.PI), 3),
        y: -(1 - n) * r * (13 * cos((t + n) * 3 * Math.PI) - 5 * cos(2 * (t + n) * 3 * Math.PI) - 2 * cos(3 * (t + n) * 3 * Math.PI) - cos(4 * (t + n) * 3 * Math.PI)) / 16,
        width: (r - r * n) / 3,
        height: (r - r * n) / 3
      };
    },
    radius: 40,
    amount: 32,
    speed: -0.25
  });
}).call(this);
