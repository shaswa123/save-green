!(function() {
	'use strict';
	!(function() {
		var l = window,
			c = l.document,
			t = l.Array,
			s = l.Object,
			r = l.String,
			m = l.Number,
			u = l.Date,
			d = l.Math,
			a = l.setTimeout,
			n = l.setInterval,
			i = l.clearTimeout,
			f = l.parseInt,
			h = l.encodeURIComponent,
			v = l.btoa,
			p = l.unescape,
			_ = l.TypeError,
			y = l.navigator,
			b = l.location,
			e = l.XMLHttpRequest,
			o = l.FormData;
		function g(i) {
			return function(e, n) {
				return arguments.length < 2
					? function(n) {
							return i.call(null, n, e);
						}
					: i.call(null, e, n);
			};
		}
		function D(t) {
			return function(e, i, n) {
				return arguments.length < 3
					? function(n) {
							return t.call(null, n, e, i);
						}
					: t.call(null, e, i, n);
			};
		}
		function R() {
			for (var n = arguments.length, e = new t(n), i = 0; i < n; i++) e[i] = arguments[i];
			return function(n) {
				return function() {
					var i = arguments;
					return e.every(function(n, e) {
						return (
							n(i[e]) ||
							(function() {
								console.error.apply(console, arguments);
							})('wrong ' + e + 'th argtype', i[e])
						);
					})
						? n.apply(null, i)
						: i[0];
				};
			};
		}
		function S(n) {
			return B(n) && 1 === n.nodeType;
		}
		var k = g(function(n, e) {
				return typeof n === e;
			}),
			w = k('boolean'),
			M = k('number'),
			P = k('string'),
			K = k('function'),
			L = k('object'),
			N = t.isArray,
			B = (k('undefined'),
			function(n) {
				return !(null === n) && L(n);
			}),
			A = function(n) {
				return !C(s.keys(n));
			},
			T = g(function(n, e) {
				return n && n[e];
			}),
			C = T('length'),
			x = T('prototype'),
			E = g(function(n, e) {
				return n instanceof e;
			}),
			G = u.now,
			$ = d.random,
			z = d.floor;
		function F(n, e) {
			return { error: ((i = e), (t = { description: r(n) }), i && (t.field = i), t) };
			var i, t;
		}
		function O(n) {
			throw new Error(n);
		}
		var H = function(n) {
			return /data:image\/[^;]+;base64/.test(n);
		};
		function U(n) {
			var e = (function a(o, r) {
				var m = {};
				if (!B(o)) return m;
				var u = null == r;
				return (
					s.keys(o).forEach(function(n) {
						var e,
							i = o[n],
							t = u ? n : r + '[' + n + ']';
						'object' == typeof i
							? ((e = a(i, t)),
								s.keys(e).forEach(function(n) {
									m[n] = e[n];
								}))
							: (m[t] = i);
					}),
					m
				);
			})(n);
			return s
				.keys(e)
				.map(function(n) {
					return h(n) + '=' + h(e[n]);
				})
				.join('&');
		}
		function I(n, e) {
			return B(e) && (e = U(e)), e && ((n += 0 < n.indexOf('?') ? '&' : '?'), (n += e)), n;
		}
		function Z(n) {
			return s.keys(n || {});
		}
		function Y(n) {
			return Kn(Pn(n));
		}
		function j(e, t, a, o) {
			return E(e, Nn)
				? console.error('use el |> _El.on(e, cb)')
				: function(i) {
						var n = t;
						return (
							P(a)
								? (n = function(n) {
										for (var e = n.target; !Qn(e, a) && e !== i; ) e = An(e);
										e !== i && ((n.delegateTarget = e), t(n));
									})
								: (o = a),
							(o = !!o),
							i.addEventListener(e, n, o),
							function() {
								return i.removeEventListener(e, n, o);
							}
						);
					};
		}
		function W(n) {
			return P(n) ? re(n) : n;
		}
		var q,
			V,
			J,
			Q,
			X,
			nn,
			en,
			tn,
			an,
			on,
			rn,
			mn,
			un,
			cn = x(t),
			ln = cn.slice,
			sn = g(function(n, e) {
				return n && cn.forEach.call(n, e), n;
			}),
			dn = ((q = 'indexOf'),
			g(function(n, e) {
				return cn[q].call(n, e);
			})),
			fn = g(function(n, e) {
				return 0 <= dn(n, e);
			}),
			hn = g(function(n, e) {
				return ln.call(n, e);
			}),
			vn = D(function(n, e, i) {
				return cn.reduce.call(n, e, i);
			}),
			pn = function(n) {
				return n;
			},
			_n = (x(Function),
			(J = function(n, e) {
				return n.bind(e);
			}),
			(V = function(n) {
				if (K(n)) return J.apply(null, arguments);
				throw new _('not a function');
			}),
			g(function(n, e) {
				var i = arguments;
				return P(n) && ((i = hn(i, 0))[0] = e[n]), V.apply(null, i);
			})),
			yn = x(r).slice,
			bn = D(function(n, e, i) {
				return yn.call(n, e, i);
			}),
			gn = g(function(n, e) {
				return yn.call(n, e);
			}),
			Dn = g(function(n, e) {
				return e in n;
			}),
			Rn = g(function(n, e) {
				return n && n.hasOwnProperty(e);
			}),
			Sn = D(function(n, e, i) {
				return (n[e] = i), n;
			}),
			kn = D(function(n, e, i) {
				return i && (n[e] = i), n;
			}),
			wn = g(function(n, e) {
				return delete n[e], n;
			}),
			Mn = g(function(e, i) {
				return (
					sn(Z(e), function(n) {
						return i(e[n], n, e);
					}),
					e
				);
			}),
			Pn = JSON.stringify,
			Kn = function(n) {
				try {
					return JSON.parse(n);
				} catch (n) {}
			},
			Ln = g(function(i, n) {
				return (
					Mn(n, function(n, e) {
						return (i[e] = n);
					}),
					i
				);
			}),
			Nn = l.Element,
			Bn = function(n) {
				return c.createElement(n || 'div');
			},
			An = function(n) {
				return n.parentNode;
			},
			Tn = R(S),
			Cn = R(S, S),
			xn = R(S, P),
			En = R(S, P, function() {
				return !0;
			}),
			Gn = R(S, B),
			$n = ((Q = Cn(function(n, e) {
				return e.appendChild(n);
			})),
			g(Q)),
			zn = ((X = Cn(function(n, e) {
				var i = e;
				return $n(n)(i), n;
			})),
			g(X)),
			Fn = Tn(function(n) {
				var e = An(n);
				return e && e.removeChild(n), n;
			}),
			On = (Tn(T('selectionStart')),
			Tn(T('selectionEnd')),
			(en = function(n, e) {
				return (n.selectionStart = n.selectionEnd = e), n;
			}),
			(nn = R(S, M)(en)),
			g(nn),
			Tn(function(n) {
				return n.submit(), n;
			})),
			Hn = D(
				En(function(n, e, i) {
					return n.setAttribute(e, i), n;
				})
			),
			Un = D(
				En(function(n, e, i) {
					return (n.style[e] = i), n;
				})
			),
			In = ((tn = Gn(function(t, n) {
				var e = n;
				return (
					Mn(function(n, e) {
						var i = t;
						return Hn(e, n)(i);
					})(e),
					t
				);
			})),
			g(tn)),
			Zn = ((an = Gn(function(t, n) {
				var e = n;
				return (
					Mn(function(n, e) {
						var i = t;
						return Un(e, n)(i);
					})(e),
					t
				);
			})),
			g(an)),
			Yn = ((on = xn(function(n, e) {
				return (n.innerHTML = e), n;
			})),
			g(on)),
			jn = ((rn = xn(function(n, e) {
				var i = n;
				return Un('display', e)(i);
			})),
			g(rn)),
			Wn = (jn('none'), jn('block'), jn('inline-block'), T('offsetWidth')),
			qn = T('offsetHeight'),
			Vn = x(Nn),
			Jn =
				Vn.matches ||
				Vn.matchesSelector ||
				Vn.webkitMatchesSelector ||
				Vn.mozMatchesSelector ||
				Vn.msMatchesSelector ||
				Vn.oMatchesSelector,
			Qn = ((mn = xn(function(n, e) {
				return Jn.call(n, e);
			})),
			g(mn)),
			Xn = c.documentElement,
			ne = c.body,
			ee = l.innerHeight,
			ie = l.pageYOffset,
			te = l.scrollBy,
			ae = l.scrollTo,
			oe = l.requestAnimationFrame,
			re = _n('querySelector', c),
			me = _n('querySelectorAll', c);
		_n('getElementById', c), _n('getComputedStyle', l);
		function ue(n, e, i, t) {
			var a, o, r, m, u, c;
			i && 'get' === i.toLowerCase()
				? ((n = I(n, e)), t ? l.open(n, t) : (l.location = n))
				: ((c = { action: n, method: i }),
					t && (c.target = t),
					(u = Bn('form')),
					(m = In(c)(u)),
					(r = Yn(ce(e))(m)),
					(o = $n(Xn)(r)),
					(a = On(o)),
					Fn(a));
		}
		function ce(n, i) {
			if (B(n)) {
				var t = '';
				return (
					Mn(n, function(n, e) {
						i && (e = i + '[' + e + ']'), (t += ce(n, e));
					}),
					t
				);
			}
			var e = Bn('input');
			return (e.type = 'hidden'), (e.value = n), (e.name = i), e.outerHTML;
		}
		function le(n) {
			!(function(m) {
				if (!l.requestAnimationFrame) return te(0, m);
				un && i(un);
				un = a(function() {
					var t = ie,
						a = d.min(t + m, qn(ne) - ee);
					m = a - t;
					var o = 0,
						r = l.performance.now();
					oe(function n(e) {
						if (1 <= (o += (e - r) / 300)) return ae(0, a);
						var i = d.sin(se * o / 2);
						ae(0, t + d.round(m * i)), (r = e), oe(n);
					});
				}, 100);
			})(n - ie);
		}
		var se = d.PI;
		var de,
			fe,
			he,
			ve,
			pe = e,
			_e = F('Network error'),
			ye = 0;
		function be(n) {
			if (!E(this, be)) return new be(n);
			(this.options = (function(n) {
				P(n) && (n = { url: n });
				var e = n.method,
					i = n.headers,
					t = n.callback,
					a = n.data;
				i || (n.headers = {});
				e || (n.method = 'get');
				t || (n.callback = pn);
				B(a) && !E(a, o) && (a = U(a));
				return (n.data = a), n;
			})(n)),
				this.defer();
		}
		(((he = {
			setReq: function(n, e) {
				return this.abort(), (this.type = n), (this.req = e), this;
			},
			till: function(e) {
				var i = this;
				return this.setReq(
					'timeout',
					a(function() {
						i.call(function(n) {
							e(n) ? i.till(e) : i.options.callback(n);
						});
					}, 3e3)
				);
			},
			abort: function() {
				var n = this.req,
					e = this.type;
				n &&
					('ajax' === e ? this.req.abort() : 'jsonp' === e ? (l.Razorpay[this.req] = pn) : i(this.req),
					(this.req = null));
			},
			defer: function() {
				var n = this;
				this.req = a(function() {
					return n.call();
				});
			},
			call: function(e) {
				var n, i, t;
				void 0 === e && (e = this.options.callback);
				var a = this.options,
					o = a.url,
					r = a.method,
					m = a.data,
					u = a.headers,
					c = new pe();
				this.setReq('ajax', c),
					c.open(r, o, !0),
					(c.onreadystatechange = function() {
						var n;
						4 === c.readyState &&
							c.status &&
							((n = Kn(c.responseText)) ||
								((n = F('Parsing error')).xhr = { status: c.status, text: c.responseText }),
							e(n));
					}),
					(c.onerror = function() {
						var n = _e;
						(n.xhr = { status: 0 }), e(n);
					}),
					(t = u),
					(i = kn('X-Razorpay-SessionId', de)(t)),
					(n = kn('X-Razorpay-TrackId', fe)(i)),
					Mn(function(n, e) {
						return c.setRequestHeader(e, n);
					})(n),
					c.send(m);
			}
		}).constructor = be).prototype = he),
			(be.post = function(n) {
				return (
					(n.method = 'post'),
					n.headers || (n.headers = {}),
					n.headers['Content-type'] || (n.headers['Content-type'] = 'application/x-www-form-urlencoded'),
					be(n)
				);
			}),
			(be.setSessionId = function(n) {
				de = n;
			}),
			(be.setTrackId = function(n) {
				fe = n;
			}),
			(be.jsonp = function(r) {
				r.data || (r.data = {});
				var m = 'jsonp' + ye++;
				r.data.callback = 'Razorpay.' + m;
				var n = new be(r);
				return (
					(r = n.options),
					(n.call = function(e) {
						var n, i;
						void 0 === e && (e = r.callback);
						function t() {
							a ||
								(this.readyState && 'loaded' !== this.readyState && 'complete' !== this.readyState) ||
								((a = !0), (this.onload = this.onreadystatechange = null), Fn(this));
						}
						var a = !1,
							o = (l.Razorpay[m] = function(n) {
								wn(n, 'http_status_code'), e(n), wn(l.Razorpay, m);
							});
						this.setReq('jsonp', o),
							(i = Bn('script')),
							(n = Ln({
								src: I(r.url, r.data),
								async: !0,
								onerror: function() {
									return r.callback(_e);
								},
								onload: t,
								onreadystatechange: t
							})(i)),
							$n(Xn)(n);
					}),
					n
				);
			});
		var ge = function(n) {
				return console.warn('Promise error:', n);
			},
			De = function(n) {
				return E(n, Re);
			};
		function Re(n) {
			if (!De(this)) throw 'new Promise';
			(this._state = 0), (this._handled = !1), (this._value = void 0), (this._deferreds = []), Ke(n, this);
		}
		function Se(i, t) {
			for (; 3 === i._state; ) i = i._value;
			0 !== i._state
				? ((i._handled = !0),
					a(function() {
						var n,
							e = 1 === i._state ? t.onFulfilled : t.onRejected;
						if (null !== e) {
							try {
								n = e(i._value);
							} catch (n) {
								return void we(t.promise, n);
							}
							ke(t.promise, n);
						} else (1 === i._state ? ke : we)(t.promise, i._value);
					}))
				: i._deferreds.push(t);
		}
		function ke(e, n) {
			try {
				if (n === e) throw new _('promise resolved by itself');
				if (B(n) || K(n)) {
					var i = n.then;
					if (De(n)) return (e._state = 3), (e._value = n), void Me(e);
					if (K(i)) return void Ke(_n(i, n), e);
				}
				(e._state = 1), (e._value = n), Me(e);
			} catch (n) {
				we(e, n);
			}
		}
		function we(n, e) {
			(n._state = 2), (n._value = e), Me(n);
		}
		function Me(e) {
			var n;
			2 === e._state &&
				0 === e._deferreds.length &&
				a(function() {
					e._handled || ge(e._value);
				}),
				(n = e._deferreds),
				sn(function(n) {
					return Se(e, n);
				})(n),
				(e._deferreds = null);
		}
		function Pe(n, e, i) {
			(this.onFulfilled = K(n) ? n : null), (this.onRejected = K(e) ? e : null), (this.promise = i);
		}
		function Ke(n, e) {
			var i = !1;
			try {
				n(
					function(n) {
						i || ((i = !0), ke(e, n));
					},
					function(n) {
						i || ((i = !0), we(e, n));
					}
				);
			} catch (n) {
				if (i) return;
				(i = !0), we(e, n);
			}
		}
		(ve = Re.prototype),
			Ln({
				catch: function(n) {
					return this.then(null, n);
				},
				then: function(n, e) {
					var i = new Re(pn);
					return Se(this, new Pe(n, e, i)), i;
				},
				finally: function(e) {
					return this.then(
						function(n) {
							return Re.resolve(e()).then(function() {
								return n;
							});
						},
						function(n) {
							return Re.resolve(e()).then(function() {
								return Re.reject(n);
							});
						}
					);
				}
			})(ve),
			(Re.all = function(r) {
				return new Re(function(t, a) {
					if (!r || void 0 === r.length) throw new _('Promise.all accepts an array');
					if (0 === r.length) return t([]);
					var o = r.length,
						n = r;
					sn(function e(n, i) {
						try {
							if ((B(n) || K(n)) && K(n.then))
								return n.then(function(n) {
									return e(n, i);
								}, a);
							(r[i] = n), 0 == --o && t(r);
						} catch (n) {
							a(n);
						}
					})(n);
				});
			}),
			(Re.resolve = function(e) {
				return De(e)
					? e
					: new Re(function(n) {
							return n(e);
						});
			}),
			(Re.reject = function(i) {
				return new Re(function(n, e) {
					return e(i);
				});
			}),
			(Re.race = function(t) {
				return new Re(function(e, i) {
					var n = t;
					return sn(function(n) {
						return n.then(e, i);
					})(n);
				});
			});
		var Le = l.Promise,
			Ne = (Le && K(x(Le).then) && Le) || Re;
		K(Ne.prototype.finally) || (Ne.prototype.finally = Re.prototype.finally);
		var Be = {
			_storage: {},
			setItem: function(n, e) {
				this._storage[n] = e;
			},
			getItem: function(n) {
				return this._storage[n] || null;
			},
			removeItem: function(n) {
				delete this._storage[n];
			}
		};
		var Ae,
			Te = (function() {
				var n = G();
				try {
					l.localStorage.setItem('_storage', n);
					var e = l.localStorage.getItem('_storage');
					return l.localStorage.removeItem('_storage'), n !== f(e) ? Be : l.localStorage;
				} catch (n) {
					return Be;
				}
			})(),
			Ce = 'rzp_checkout_exp';
		var xe = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
			Ee = ((Ae = xe),
			vn(function(n, e, i) {
				return Sn(n, e, i);
			}, {})(Ae));
		function Ge(n) {
			for (var e = ''; n; ) (e = xe[n % 62] + e), (n = z(n / 62));
			return e;
		}
		function $e() {
			var i,
				t = Ge(r(G() - 13885344e5) + gn('000000' + z(1e6 * $()), -6)) + Ge(z(238328 * $())) + '0',
				a = 0,
				n = t;
			return (
				sn(function(n, e) {
					(i = Ee[t[t.length - 1 - e]]),
						(t.length - e) % 2 && (i *= 2),
						62 <= i && (i = i % 62 + 1),
						(a += i);
				})(n),
				(i = (i = a % 62) && xe[62 - i]),
				bn(t, 0, 13) + i
			);
		}
		var ze = $e(),
			Fe = { library: 'checkoutjs', platform: 'browser', referer: b.href };
		function Oe(n) {
			var i = { checkout_id: n ? n.id : ze },
				e = [
					'device',
					'env',
					'integration',
					'library',
					'os_version',
					'os',
					'platform_version',
					'platform',
					'referer'
				];
			return (
				sn(function(n) {
					var e = i;
					return kn(n, Fe[n])(e);
				})(e),
				i
			);
		}
		var He,
			Ue = [],
			Ie = [],
			Ze = function(n) {
				return Ue.push(n);
			},
			Ye = function(n) {
				He = n;
			},
			je = function() {
				var n, e, i, t;
				if (Ue.length) {
					var a = Dn(y, 'sendBeacon'),
						o = {
							context: He,
							addons: [ { name: 'ua_parser', input_key: 'user_agent', output_key: 'user_agent_parsed' } ],
							events: Ue.splice(0, Ue.length)
						},
						r = {
							url: 'https://lumberjack.razorpay.com/v1/track',
							data: {
								key: 'ZmY5N2M0YzVkN2JiYzkyMWM1ZmVmYWJk',
								data: ((t = Pn(o)), (i = h(t)), (e = p(i)), (n = v(e)), h(n))
							}
						};
					try {
						a ? y.sendBeacon(r.url, Pn(r.data)) : be.post(r);
					} catch (n) {}
				}
			};
		n(function() {
			je();
		}, 1e3);
		function We(m, u, c, l) {
			m
				? m.isLiveMode() &&
					a(function() {
						var n;
						c instanceof Error && (c = { message: c.message, stack: c.stack });
						var e = Oe(m);
						(e.user_agent = null), (e.mode = 'live');
						var i = m.get('order_id');
						i && (e.order_id = i);
						var a = {},
							t = { options: a };
						c && (t.data = c);
						var o = [
							'amount',
							'checkout_config_id',
							'contact_id',
							'currency',
							'description',
							'display_amount',
							'display_currency',
							'ecod',
							'hidden',
							'image',
							'key',
							'method',
							'name',
							'prefill',
							'readonly',
							'recurring',
							'redirect',
							'theme'
						];
						Mn(m.get(), function(n, e) {
							var i = e.split('.'),
								t = i[0];
							-1 !== o.indexOf(t) &&
								(1 < i.length ? (a.hasOwnProperty(t) || (a[t] = {}), (a[t][i[1]] = n)) : (a[e] = n));
						}),
							Dn(a, 'prefill') &&
								sn([ 'card[number]', 'card[cvv]', 'card[expiry]' ], function(n) {
									Dn(a.prefill, n) && (a.prefill[n] = !0);
								}),
							a.image && H(a.image) && (a.image = 'base64');
						var r = m.get('external.wallets') || [];
						(a.external_wallets = ((n = r),
						vn(function(n, e) {
							var i = n;
							return Sn(e, !0)(i);
						}, {})(n))),
							ze && (t.local_order_id = ze),
							(t.build_number = 8945),
							(t.experiments = (function() {
								try {
									var n = Te.getItem(Ce),
										e = Kn(n);
								} catch (n) {}
								return B(e) && !N(e) ? e : {};
							})()),
							Ze({ event: u, properties: t, timestamp: G() }),
							Ye(e),
							l && je();
					})
				: Ie.push([ u, c, l ]);
		}
		(We.dispatchPendingEvents = function(n) {
			var e;
			n &&
				((e = We.bind(We, n)),
				Ie.splice(0, Ie.length).forEach(function(n) {
					e.apply(We, n);
				}));
		}),
			(We.parseAnalyticsData = function(n) {
				var e;
				B(n) &&
					((e = n),
					Mn(function(n, e) {
						Fe[n] = e;
					})(e));
			}),
			(We.makeUid = $e),
			(We.common = Oe),
			(We.props = Fe),
			(We.id = ze),
			(We.updateUid = function(n) {
				We.id = ze = n;
			}),
			(We.flush = je);
		function qe(n) {
			var i = (function t(n, a) {
				void 0 === a && (a = '');
				var o = {};
				return (
					Mn(n, function(n, e) {
						var i = a ? a + '.' + e : e;
						B(n) ? Ln(o, t(n, i)) : (o[i] = n);
					}),
					o
				);
			})(n);
			return (
				Mn(i, function(n, e) {
					K(n) && (i[e] = n.call());
				}),
				i
			);
		}
		var Ve,
			Je = {},
			Qe = {
				setR: function(n) {
					We.dispatchPendingEvents((Ve = n));
				},
				track: function(n, e) {
					var i,
						t = void 0 === e ? {} : e,
						a = t.type,
						o = t.data,
						r = void 0 === o ? {} : o,
						m = t.r,
						u = void 0 === m ? Ve : m,
						c = t.immediately,
						l = void 0 !== c && c,
						s = qe(Je);
					(i = Y(r || {})),
						[ 'token' ].forEach(function(n) {
							i[n] && (i[n] = '__REDACTED__');
						}),
						(r = B((r = i)) ? Y(r) : { data: r }).meta && B(r.meta) && (s = Ln(s, r.meta)),
						(r.meta = s),
						a && (n = a + ':' + n),
						We(u, n, r, l);
				},
				setMeta: function(n, e) {
					Sn(Je, n, e);
				},
				removeMeta: function(n) {
					wn(Je, n);
				},
				getMeta: function() {
					return (
						(e = {}),
						Mn(Je, function(i, n) {
							var t = (n = n.replace(/\[([^[\]]+)\]/g, '.$1')).split('.'),
								a = e;
							sn(t, function(n, e) {
								e < t.length - 1 ? (a[n] || (a[n] = {}), (a = a[n])) : (a[n] = i);
							});
						}),
						e
					);
					var e;
				}
			};
		function Xe() {
			return (this._evts = {}), (this._defs = {}), this;
		}
		Xe.prototype = {
			onNew: pn,
			def: function(n, e) {
				this._defs[n] = e;
			},
			on: function(n, e) {
				var i;
				return (
					P(n) && K(e) && ((i = this._evts)[n] || (i[n] = []), !1 !== this.onNew(n, e) && i[n].push(e)), this
				);
			},
			once: function(e, n) {
				var i = n,
					t = this;
				return (
					(n = function n() {
						i.apply(t, arguments), t.off(e, n);
					}),
					this.on(e, n)
				);
			},
			off: function(i, n) {
				var e = arguments.length;
				if (!e) return Xe.call(this);
				var t = this._evts;
				if (2 === e) {
					var a = t[i];
					if (!K(n) || !N(a)) return;
					if ((a.splice(dn(a, n), 1), a.length)) return;
				}
				return (
					t[i]
						? delete t[i]
						: ((i += '.'),
							Mn(t, function(n, e) {
								e.indexOf(i) || delete t[e];
							})),
					this
				);
			},
			emit: function(n, e) {
				var i = this;
				return (
					sn(this._evts[n], function(n) {
						try {
							n.call(i, e);
						} catch (n) {
							console.error;
						}
					}),
					this
				);
			},
			emitter: function() {
				var n = arguments,
					e = this;
				return function() {
					e.emit.apply(e, n);
				};
			}
		};
		var ni = y.userAgent,
			ei = y.vendor;
		function ii(n) {
			return n.test(ni);
		}
		function ti(n) {
			return n.test(ei);
		}
		ii(/MSIE |Trident\//);
		var ai = ii(/iPhone/),
			oi = ai || ii(/iPad/),
			ri = (ii(/Android/),
			ii(/^((?!chrome|android).)*safari/i) || ti(/Apple/),
			ii(/firefox/),
			ii(/Chrome/) && ti(/Google Inc/),
			ii(/; wv\) |Gecko\) Version\/[^ ]+ Chrome|Windows Phone|Opera Mini|UCBrowser|FBAN|CriOS/) ||
				oi ||
				ii(/Android 4/)),
			mi = (ii(/iPhone/), (mi = ni.match(/Chrome\/(\d+)/)) && f(mi[1], 10)),
			ui = (ii(/(Vivo|HeyTap|Realme|Oppo)Browser/),
			{
				key: '',
				account_id: '',
				image: '',
				amount: 100,
				currency: 'INR',
				order_id: '',
				invoice_id: '',
				subscription_id: '',
				auth_link_id: '',
				payment_link_id: '',
				notes: null,
				callback_url: '',
				redirect: !1,
				description: '',
				customer_id: '',
				recurring: null,
				payout: null,
				contact_id: '',
				signature: '',
				retry: !0,
				target: '',
				subscription_card_change: null,
				display_currency: '',
				display_amount: '',
				recurring_token: { max_amount: 0, expire_by: 0 },
				checkout_config_id: '',
				send_sms_hash: !1
			});
		function ci(n, e, i, t) {
			var a = e[(i = i.toLowerCase())],
				o = typeof a;
			'object' == o && null === a
				? P(t) && ('true' === t || '1' === t ? (t = !0) : ('false' !== t && '0' !== t) || (t = !1))
				: 'string' == o && (M(t) || w(t))
					? (t = r(t))
					: 'number' == o
						? (t = m(t))
						: 'boolean' == o &&
							(P(t)
								? 'true' === t || '1' === t ? (t = !0) : ('false' !== t && '0' !== t) || (t = !1)
								: M(t) && (t = !!t)),
				(null !== a && o != typeof t) || (n[i] = t);
		}
		function li(t, a, o) {
			Mn(t[a], function(n, e) {
				var i = typeof n;
				('string' != i && 'number' != i && 'boolean' != i) ||
					((e = a + o[0] + e), 1 < o.length && (e += o[1]), (t[e] = n));
			}),
				delete t[a];
		}
		function si(n, t) {
			var a = {};
			return (
				Mn(n, function(n, i) {
					i in di
						? Mn(n, function(n, e) {
								ci(a, t, i + '.' + e, n);
							})
						: ci(a, t, i, n);
				}),
				a
			);
		}
		var di = {};
		function fi(i) {
			Mn(ui, function(n, i) {
				B(n) &&
					!A(n) &&
					((di[i] = !0),
					Mn(n, function(n, e) {
						ui[i + '.' + e] = n;
					}),
					delete ui[i]);
			}),
				(i = si(i, ui)).callback_url && ri && (i.redirect = !0),
				(this.get = function(n) {
					return arguments.length ? (n in i ? i[n] : ui[n]) : i;
				}),
				(this.set = function(n, e) {
					i[n] = e;
				}),
				(this.unset = function(n) {
					delete i[n];
				});
		}
		var hi,
			vi,
			pi,
			_i = '',
			yi = l.screen;
		try {
			(pi = [
				y.userAgent,
				y.language,
				new u().getTimezoneOffset(),
				y.platform,
				y.cpuClass,
				y.hardwareConcurrency,
				yi.colorDepth,
				y.deviceMemory,
				yi.width + yi.height,
				yi.width * yi.height,
				l.devicePixelRatio
			]),
				(hi = pi.join()),
				(vi = new l.TextEncoder('utf-8').encode(hi)),
				(_i = void l.crypto.subtle.digest('SHA-1', vi).then(function(n) {
					return (_i = (function(n) {
						for (var e = [], i = new l.DataView(n), t = 0; t < i.byteLength; t += 4) {
							var a = i.getUint32(t).toString(16),
								o = '00000000',
								r = (o + a).slice(-o.length);
							e.push(r);
						}
						return e.join('');
					})(n));
				}));
		} catch (n) {}
		var bi = { api: 'https://api.razorpay.com/', version: 'v1/', frameApi: '/', cdn: 'https://cdn.razorpay.com/' };
		try {
			Ln(bi, l.Razorpay.config);
		} catch (n) {}
		function gi(n, i, e) {
			var t;
			void 0 === e && (e = {});
			var a = Y(n);
			e.feesRedirect && (a.view = 'html');
			var o = i.get;
			sn(
				[
					'amount',
					'currency',
					'signature',
					'description',
					'order_id',
					'account_id',
					'notes',
					'subscription_id',
					'auth_link_id',
					'payment_link_id',
					'customer_id',
					'recurring',
					'subscription_card_change',
					'recurring_token.max_amount',
					'recurring_token.expire_by'
				],
				function(n) {
					var e,
						i = a;
					Rn(n)(i) || ((e = o(n)) && (w(e) && (e = 1), (a[n.replace(/\.(\w+)/g, '[$1]')] = e)));
				}
			);
			var r = o('key');
			if (
				(!a.key_id && r && (a.key_id = r),
				e.avoidPopup && 'wallet' === a.method && (a['_[source]'] = 'checkoutjs'),
				e.tez || e.gpay)
			) {
				if (!i.paymentAdapters || (!i.paymentAdapters.gpay && !i.paymentAdapters['microapps.gpay']))
					return i.emit('payment.error', F('GPay is not available'));
				(a['_[flow]'] = 'intent'), (a['_[app]'] = 'com.google.android.apps.nbu.paisa.user');
			}
			sn([ 'integration', 'integration_version', 'integration_parent_version' ], function(n) {
				var e = i.get('_.' + n);
				e && (a['_[' + n + ']'] = e);
			}),
				_i && (a['_[shield][fhash]'] = _i),
				(a['_[shield][tz]'] = -new u().getTimezoneOffset()),
				(t = Mi),
				Mn(function(n, e) {
					a['_[shield][' + e + ']'] = n;
				})(t),
				(a['_[build]'] = 8945),
				li(a, 'notes', '[]'),
				li(a, 'card', '[]');
			var m = a['card[expiry]'];
			return (
				P(m) &&
					((a['card[expiry_month]'] = m.slice(0, 2)),
					(a['card[expiry_year]'] = m.slice(-2)),
					delete a['card[expiry]']),
				(a._ = We.common()),
				li(a, '_', '[]'),
				a
			);
		}
		function Di(t, a) {
			return (
				void 0 === a && (a = '.'),
				function(n) {
					for (var e = a, i = 0; i < t; i++) e += '0';
					return n.replace(e, '');
				}
			);
		}
		function Ri(n, e) {
			return void 0 === e && (e = ','), n.replace(/\./, e);
		}
		function Si(a) {
			Mn(a, function(n, e) {
				var i, t;
				(Li[e] = ((t = {}), (i = Ln(Li.default)(t)), Ln(Li[e] || {})(i))),
					(Li[e].code = e),
					a[e] && (Li[e].symbol = a[e]);
			});
		}
		var ki,
			wi,
			Mi = {},
			Pi = {
				AED: {
					code: '784',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'د.إ',
					name: 'Emirati Dirham'
				},
				ALL: {
					code: '008',
					denomination: 100,
					min_value: 221,
					min_auth_value: 100,
					symbol: 'Lek',
					name: 'Albanian Lek'
				},
				AMD: {
					code: '051',
					denomination: 100,
					min_value: 975,
					min_auth_value: 100,
					symbol: '֏',
					name: 'Armenian Dram'
				},
				ARS: {
					code: '032',
					denomination: 100,
					min_value: 80,
					min_auth_value: 100,
					symbol: '$',
					name: 'Argentine Peso'
				},
				AUD: {
					code: '036',
					denomination: 100,
					min_value: 50,
					min_auth_value: 100,
					symbol: '$',
					name: 'Australian Dollar'
				},
				AWG: {
					code: '533',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'ƒ',
					name: 'Aruban or Dutch Guilder'
				},
				BBD: {
					code: '052',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: '$',
					name: 'Barbadian or Bajan Dollar'
				},
				BDT: {
					code: '050',
					denomination: 100,
					min_value: 168,
					min_auth_value: 100,
					symbol: '৳',
					name: 'Bangladeshi Taka'
				},
				BMD: {
					code: '060',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: '$',
					name: 'Bermudian Dollar'
				},
				BND: {
					code: '096',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'B$',
					name: 'Bruneian Dollar'
				},
				BOB: {
					code: '068',
					denomination: 100,
					min_value: 14,
					min_auth_value: 100,
					symbol: 'Bs',
					name: 'Bolivian Bolíviano'
				},
				BSD: {
					code: '044',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'B$',
					name: 'Bahamian Dollar'
				},
				BWP: {
					code: '072',
					denomination: 100,
					min_value: 22,
					min_auth_value: 100,
					symbol: 'P',
					name: 'Botswana Pula'
				},
				BZD: {
					code: '084',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'BZ$',
					name: 'Belizean Dollar'
				},
				CAD: {
					code: '124',
					denomination: 100,
					min_value: 50,
					min_auth_value: 100,
					symbol: 'C$',
					name: 'Canadian Dollar'
				},
				CHF: {
					code: '756',
					denomination: 100,
					min_value: 50,
					min_auth_value: 100,
					symbol: '₣',
					name: 'Swiss Franc'
				},
				CNY: {
					code: '156',
					denomination: 100,
					min_value: 14,
					min_auth_value: 100,
					symbol: '¥',
					name: 'Chinese Yuan Renminbi'
				},
				COP: {
					code: '170',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: '$',
					name: 'Colombian Peso'
				},
				CRC: {
					code: '188',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: '₡',
					name: 'Costa Rican Colon'
				},
				CUP: {
					code: '192',
					denomination: 100,
					min_value: 53,
					min_auth_value: 100,
					symbol: '$',
					name: 'Cuban Peso'
				},
				CZK: {
					code: '203',
					denomination: 100,
					min_value: 46,
					min_auth_value: 100,
					symbol: 'Kč',
					name: 'Czech Koruna'
				},
				DKK: {
					code: '208',
					denomination: 100,
					min_value: 250,
					min_auth_value: 100,
					symbol: 'kr',
					name: 'Danish Krone'
				},
				DOP: {
					code: '214',
					denomination: 100,
					min_value: 102,
					min_auth_value: 100,
					symbol: '$',
					name: 'Dominican Peso'
				},
				DZD: {
					code: '012',
					denomination: 100,
					min_value: 239,
					min_auth_value: 100,
					symbol: 'د.ج',
					name: 'Algerian Dinar'
				},
				EGP: {
					code: '818',
					denomination: 100,
					min_value: 35,
					min_auth_value: 100,
					symbol: '£',
					name: 'Egyptian Pound'
				},
				ETB: {
					code: '230',
					denomination: 100,
					min_value: 57,
					min_auth_value: 100,
					symbol: 'ብር',
					name: 'Ethiopian Birr'
				},
				EUR: { code: '978', denomination: 100, min_value: 50, min_auth_value: 100, symbol: '€', name: 'Euro' },
				FJD: {
					code: '242',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'FJ$',
					name: 'Fijian Dollar'
				},
				GBP: {
					code: '826',
					denomination: 100,
					min_value: 30,
					min_auth_value: 100,
					symbol: '£',
					name: 'British Pound'
				},
				GIP: {
					code: '292',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: '£',
					name: 'Gibraltar Pound'
				},
				GMD: {
					code: '270',
					denomination: 100,
					min_value: 100,
					min_auth_value: 100,
					symbol: 'D',
					name: 'Gambian Dalasi'
				},
				GTQ: {
					code: '320',
					denomination: 100,
					min_value: 16,
					min_auth_value: 100,
					symbol: 'Q',
					name: 'Guatemalan Quetzal'
				},
				GYD: {
					code: '328',
					denomination: 100,
					min_value: 418,
					min_auth_value: 100,
					symbol: 'G$',
					name: 'Guyanese Dollar'
				},
				HKD: {
					code: '344',
					denomination: 100,
					min_value: 400,
					min_auth_value: 100,
					symbol: 'HK$',
					name: 'Hong Kong Dollar'
				},
				HNL: {
					code: '340',
					denomination: 100,
					min_value: 49,
					min_auth_value: 100,
					symbol: 'L',
					name: 'Honduran Lempira'
				},
				HRK: {
					code: '191',
					denomination: 100,
					min_value: 14,
					min_auth_value: 100,
					symbol: 'kn',
					name: 'Croatian Kuna'
				},
				HTG: {
					code: '332',
					denomination: 100,
					min_value: 167,
					min_auth_value: 100,
					symbol: 'G',
					name: 'Haitian Gourde'
				},
				HUF: {
					code: '348',
					denomination: 100,
					min_value: 555,
					min_auth_value: 100,
					symbol: 'Ft',
					name: 'Hungarian Forint'
				},
				IDR: {
					code: '360',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: 'Rp',
					name: 'Indonesian Rupiah'
				},
				ILS: {
					code: '376',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: '₪',
					name: 'Israeli Shekel'
				},
				INR: {
					code: '356',
					denomination: 100,
					min_value: 100,
					min_auth_value: 100,
					symbol: '₹',
					name: 'Indian Rupee'
				},
				JMD: {
					code: '388',
					denomination: 100,
					min_value: 250,
					min_auth_value: 100,
					symbol: '$',
					name: 'Jamaican Dollar'
				},
				KES: {
					code: '404',
					denomination: 100,
					min_value: 201,
					min_auth_value: 100,
					symbol: 'Ksh',
					name: 'Kenyan Shilling'
				},
				KGS: {
					code: '417',
					denomination: 100,
					min_value: 140,
					min_auth_value: 100,
					symbol: 'Лв',
					name: 'Kyrgyzstani Som'
				},
				KHR: {
					code: '116',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: '៛',
					name: 'Cambodian Riel'
				},
				KYD: {
					code: '136',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: '$',
					name: 'Caymanian Dollar'
				},
				KZT: {
					code: '398',
					denomination: 100,
					min_value: 759,
					min_auth_value: 100,
					symbol: '₸',
					name: 'Kazakhstani Tenge'
				},
				LAK: {
					code: '418',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: '₭',
					name: 'Lao Kip'
				},
				LBP: {
					code: '422',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: '&#1604;.&#1604;.',
					name: 'Lebanese Pound'
				},
				LKR: {
					code: '144',
					denomination: 100,
					min_value: 358,
					min_auth_value: 100,
					symbol: 'රු',
					name: 'Sri Lankan Rupee'
				},
				LRD: {
					code: '430',
					denomination: 100,
					min_value: 325,
					min_auth_value: 100,
					symbol: 'L$',
					name: 'Liberian Dollar'
				},
				LSL: {
					code: '426',
					denomination: 100,
					min_value: 29,
					min_auth_value: 100,
					symbol: 'L',
					name: 'Basotho Loti'
				},
				MAD: {
					code: '504',
					denomination: 100,
					min_value: 20,
					min_auth_value: 100,
					symbol: 'د.م.',
					name: 'Moroccan Dirham'
				},
				MDL: {
					code: '498',
					denomination: 100,
					min_value: 35,
					min_auth_value: 100,
					symbol: 'L',
					name: 'Moldovan Leu'
				},
				MKD: {
					code: '807',
					denomination: 100,
					min_value: 109,
					min_auth_value: 100,
					symbol: 'ден',
					name: 'Macedonian Denar'
				},
				MMK: {
					code: '104',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: 'K',
					name: 'Burmese Kyat'
				},
				MNT: {
					code: '496',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: '₮',
					name: 'Mongolian Tughrik'
				},
				MOP: {
					code: '446',
					denomination: 100,
					min_value: 17,
					min_auth_value: 100,
					symbol: 'P',
					name: 'Macau Pataca'
				},
				MUR: {
					code: '480',
					denomination: 100,
					min_value: 70,
					min_auth_value: 100,
					symbol: 'Rs',
					name: 'Mauritian Rupee'
				},
				MVR: {
					code: '462',
					denomination: 100,
					min_value: 31,
					min_auth_value: 100,
					symbol: 'Rf',
					name: 'Maldivian Rufiyaa'
				},
				MWK: {
					code: '454',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: 'MK',
					name: 'Malawian Kwacha'
				},
				MXN: {
					code: '484',
					denomination: 100,
					min_value: 39,
					min_auth_value: 100,
					symbol: 'Mex$',
					name: 'Mexican Peso'
				},
				MYR: {
					code: '458',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'RM',
					name: 'Malaysian Ringgit'
				},
				NAD: {
					code: '516',
					denomination: 100,
					min_value: 29,
					min_auth_value: 100,
					symbol: 'N$',
					name: 'Namibian Dollar'
				},
				NGN: {
					code: '566',
					denomination: 100,
					min_value: 723,
					min_auth_value: 100,
					symbol: '₦',
					name: 'Nigerian Naira'
				},
				NIO: {
					code: '558',
					denomination: 100,
					min_value: 66,
					min_auth_value: 100,
					symbol: 'C$',
					name: 'Nicaraguan Cordoba'
				},
				NOK: {
					code: '578',
					denomination: 100,
					min_value: 300,
					min_auth_value: 100,
					symbol: 'kr',
					name: 'Norwegian Krone'
				},
				NPR: {
					code: '524',
					denomination: 100,
					min_value: 221,
					min_auth_value: 100,
					symbol: 'रू',
					name: 'Nepalese Rupee'
				},
				NZD: {
					code: '554',
					denomination: 100,
					min_value: 50,
					min_auth_value: 100,
					symbol: '$',
					name: 'New Zealand Dollar'
				},
				PEN: {
					code: '604',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'S/',
					name: 'Peruvian Sol'
				},
				PGK: {
					code: '598',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'K',
					name: 'Papua New Guinean Kina'
				},
				PHP: {
					code: '608',
					denomination: 100,
					min_value: 106,
					min_auth_value: 100,
					symbol: '₱',
					name: 'Philippine Peso'
				},
				PKR: {
					code: '586',
					denomination: 100,
					min_value: 227,
					min_auth_value: 100,
					symbol: 'Rs',
					name: 'Pakistani Rupee'
				},
				QAR: {
					code: '634',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'QR',
					name: 'Qatari Riyal'
				},
				RUB: {
					code: '643',
					denomination: 100,
					min_value: 130,
					min_auth_value: 100,
					symbol: '₽',
					name: 'Russian Ruble'
				},
				SAR: {
					code: '682',
					denomination: 100,
					min_value: 10,
					min_auth_value: 100,
					symbol: 'SR',
					name: 'Saudi Arabian Riyal'
				},
				SCR: {
					code: '690',
					denomination: 100,
					min_value: 28,
					min_auth_value: 100,
					symbol: 'SRe',
					name: 'Seychellois Rupee'
				},
				SEK: {
					code: '752',
					denomination: 100,
					min_value: 300,
					min_auth_value: 100,
					symbol: 'kr',
					name: 'Swedish Krona'
				},
				SGD: {
					code: '702',
					denomination: 100,
					min_value: 50,
					min_auth_value: 100,
					symbol: 'S$',
					name: 'Singapore Dollar'
				},
				SLL: {
					code: '694',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: 'Le',
					name: 'Sierra Leonean Leone'
				},
				SOS: {
					code: '706',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: 'Sh.so.',
					name: 'Somali Shilling'
				},
				SSP: {
					code: '728',
					denomination: 100,
					min_value: 100,
					min_auth_value: 100,
					symbol: '£',
					name: 'South Sudanese Pound'
				},
				SVC: {
					code: '222',
					denomination: 100,
					min_value: 18,
					min_auth_value: 100,
					symbol: '$',
					name: 'Salvadoran Colon'
				},
				SZL: {
					code: '748',
					denomination: 100,
					min_value: 29,
					min_auth_value: 100,
					symbol: 'L',
					name: 'Swazi Lilangeni'
				},
				THB: {
					code: '764',
					denomination: 100,
					min_value: 64,
					min_auth_value: 100,
					symbol: '฿',
					name: 'Thai Baht'
				},
				TTD: {
					code: '780',
					denomination: 100,
					min_value: 14,
					min_auth_value: 100,
					symbol: '$',
					name: 'Trinidadian Dollar'
				},
				TZS: {
					code: '834',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: 'Sh',
					name: 'Tanzanian Shilling'
				},
				USD: {
					code: '840',
					denomination: 100,
					min_value: 50,
					min_auth_value: 100,
					symbol: '$',
					name: 'US Dollar'
				},
				UYU: {
					code: '858',
					denomination: 100,
					min_value: 67,
					min_auth_value: 100,
					symbol: '$',
					name: 'Uruguayan Peso'
				},
				UZS: {
					code: '860',
					denomination: 100,
					min_value: 1e3,
					min_auth_value: 100,
					symbol: "so'm",
					name: 'Uzbekistani Som'
				},
				YER: {
					code: '886',
					denomination: 100,
					min_value: 501,
					min_auth_value: 100,
					symbol: '﷼',
					name: 'Yemeni Rial'
				},
				ZAR: {
					code: '710',
					denomination: 100,
					min_value: 29,
					min_auth_value: 100,
					symbol: 'R',
					name: 'South African Rand'
				}
			},
			Ki = {
				three: function(n, e) {
					var i = r(n).replace(new RegExp('(.{1,3})(?=(...)+(\\..{' + e + '})$)', 'g'), '$1,');
					return Di(e)(i);
				},
				threecommadecimal: function(n, e) {
					var i = Ri(r(n)).replace(new RegExp('(.{1,3})(?=(...)+(\\,.{' + e + '})$)', 'g'), '$1.');
					return Di(e, ',')(i);
				},
				threespaceseparator: function(n, e) {
					var i = r(n).replace(new RegExp('(.{1,3})(?=(...)+(\\..{' + e + '})$)', 'g'), '$1 ');
					return Di(e)(i);
				},
				threespacecommadecimal: function(n, e) {
					var i = Ri(r(n)).replace(new RegExp('(.{1,3})(?=(...)+(\\,.{' + e + '})$)', 'g'), '$1 ');
					return Di(e, ',')(i);
				},
				szl: function(n, e) {
					var i = r(n).replace(new RegExp('(.{1,3})(?=(...)+(\\..{' + e + '})$)', 'g'), '$1, ');
					return Di(e)(i);
				},
				chf: function(n, e) {
					var i = r(n).replace(new RegExp('(.{1,3})(?=(...)+(\\..{' + e + '})$)', 'g'), "$1'");
					return Di(e)(i);
				},
				inr: function(n, e) {
					var i = r(n).replace(new RegExp('(.{1,2})(?=.(..)+(\\..{' + e + '})$)', 'g'), '$1,');
					return Di(e)(i);
				},
				none: function(n) {
					return r(n);
				}
			},
			Li = {
				default: { decimals: 2, format: Ki.three, minimum: 100 },
				AED: { minor: 'fil', minimum: 10 },
				AFN: { minor: 'pul' },
				ALL: { minor: 'qindarka', minimum: 221 },
				AMD: { minor: 'luma', minimum: 975 },
				ANG: { minor: 'cent' },
				AOA: { minor: 'lwei' },
				ARS: { format: Ki.threecommadecimal, minor: 'centavo', minimum: 80 },
				AUD: { format: Ki.threespaceseparator, minimum: 50, minor: 'cent' },
				AWG: { minor: 'cent', minimum: 10 },
				AZN: { minor: 'qäpik' },
				BAM: { minor: 'fenning' },
				BBD: { minor: 'cent', minimum: 10 },
				BDT: { minor: 'paisa', minimum: 168 },
				BGN: { minor: 'stotinki' },
				BHD: { decimals: 3, minor: 'fils' },
				BIF: { decimals: 0, major: 'franc', minor: 'centime' },
				BMD: { minor: 'cent', minimum: 10 },
				BND: { minor: 'sen', minimum: 10 },
				BOB: { minor: 'centavo', minimum: 14 },
				BRL: { format: Ki.threecommadecimal, minimum: 50, minor: 'centavo' },
				BSD: { minor: 'cent', minimum: 10 },
				BTN: { minor: 'chetrum' },
				BWP: { minor: 'thebe', minimum: 22 },
				BYR: { decimals: 0, major: 'ruble' },
				BZD: { minor: 'cent', minimum: 10 },
				CAD: { minimum: 50, minor: 'cent' },
				CDF: { minor: 'centime' },
				CHF: { format: Ki.chf, minimum: 50, minor: 'rappen' },
				CLP: { decimals: 0, format: Ki.none, major: 'peso', minor: 'centavo' },
				CNY: { minor: 'jiao', minimum: 14 },
				COP: { format: Ki.threecommadecimal, minor: 'centavo', minimum: 1e3 },
				CRC: { format: Ki.threecommadecimal, minor: 'centimo', minimum: 1e3 },
				CUC: { minor: 'centavo' },
				CUP: { minor: 'centavo', minimum: 53 },
				CVE: { minor: 'centavo' },
				CZK: { format: Ki.threecommadecimal, minor: 'haler', minimum: 46 },
				DJF: { decimals: 0, major: 'franc', minor: 'centime' },
				DKK: { minimum: 250, minor: 'øre' },
				DOP: { minor: 'centavo', minimum: 102 },
				DZD: { minor: 'centime', minimum: 239 },
				EGP: { minor: 'piaster', minimum: 35 },
				ERN: { minor: 'cent' },
				ETB: { minor: 'cent', minimum: 57 },
				EUR: { minimum: 50, minor: 'cent' },
				FJD: { minor: 'cent', minimum: 10 },
				FKP: { minor: 'pence' },
				GBP: { minimum: 30, minor: 'pence' },
				GEL: { minor: 'tetri' },
				GIP: { minor: 'pence', minimum: 10 },
				GMD: { minor: 'butut' },
				GTQ: { minor: 'centavo', minimum: 16 },
				GYD: { minor: 'cent', minimum: 418 },
				HKD: { minimum: 400, minor: 'cent' },
				HNL: { minor: 'centavo', minimum: 49 },
				HRK: { format: Ki.threecommadecimal, minor: 'lipa', minimum: 14 },
				HTG: { minor: 'centime', minimum: 167 },
				HUF: { decimals: 0, format: Ki.none, major: 'forint', minimum: 555 },
				IDR: { format: Ki.threecommadecimal, minor: 'sen', minimum: 1e3 },
				ILS: { minor: 'agorot', minimum: 10 },
				INR: { format: Ki.inr, minor: 'paise' },
				IQD: { decimals: 3, minor: 'fil' },
				IRR: { minor: 'rials' },
				ISK: { decimals: 0, format: Ki.none, major: 'króna', minor: 'aurar' },
				JMD: { minor: 'cent', minimum: 250 },
				JOD: { decimals: 3, minor: 'fil' },
				JPY: { decimals: 0, minimum: 50, minor: 'sen' },
				KES: { minor: 'cent', minimum: 201 },
				KGS: { minor: 'tyyn', minimum: 140 },
				KHR: { minor: 'sen', minimum: 1e3 },
				KMF: { decimals: 0, major: 'franc', minor: 'centime' },
				KPW: { minor: 'chon' },
				KRW: { decimals: 0, major: 'won', minor: 'chon' },
				KWD: { decimals: 3, minor: 'fil' },
				KYD: { minor: 'cent', minimum: 10 },
				KZT: { minor: 'tiyn', minimum: 759 },
				LAK: { minor: 'at', minimum: 1e3 },
				LBP: { format: Ki.threespaceseparator, minor: 'piastre', minimum: 1e3 },
				LKR: { minor: 'cent', minimum: 358 },
				LRD: { minor: 'cent', minimum: 325 },
				LSL: { minor: 'lisente', minimum: 29 },
				LTL: { format: Ki.threespacecommadecimal, minor: 'centu' },
				LVL: { minor: 'santim' },
				LYD: { decimals: 3, minor: 'dirham' },
				MAD: { minor: 'centime', minimum: 20 },
				MDL: { minor: 'ban', minimum: 35 },
				MGA: { decimals: 0, major: 'ariary' },
				MKD: { minor: 'deni' },
				MMK: { minor: 'pya', minimum: 1e3 },
				MNT: { minor: 'mongo', minimum: 1e3 },
				MOP: { minor: 'avo', minimum: 17 },
				MRO: { minor: 'khoum' },
				MUR: { minor: 'cent', minimum: 70 },
				MVR: { minor: 'lari', minimum: 31 },
				MWK: { minor: 'tambala', minimum: 1e3 },
				MXN: { minor: 'centavo', minimum: 39 },
				MYR: { minor: 'sen', minimum: 10 },
				MZN: { decimals: 0, major: 'metical' },
				NAD: { minor: 'cent', minimum: 29 },
				NGN: { minor: 'kobo', minimum: 723 },
				NIO: { minor: 'centavo', minimum: 66 },
				NOK: { format: Ki.threecommadecimal, minimum: 300, minor: 'øre' },
				NPR: { minor: 'paise', minimum: 221 },
				NZD: { minimum: 50, minor: 'cent' },
				OMR: { minor: 'baiza', decimals: 3 },
				PAB: { minor: 'centesimo' },
				PEN: { minor: 'centimo', minimum: 10 },
				PGK: { minor: 'toea', minimum: 10 },
				PHP: { minor: 'centavo', minimum: 106 },
				PKR: { minor: 'paisa', minimum: 227 },
				PLN: { format: Ki.threespacecommadecimal, minor: 'grosz' },
				PYG: { decimals: 0, major: 'guarani', minor: 'centimo' },
				QAR: { minor: 'dirham', minimum: 10 },
				RON: { format: Ki.threecommadecimal, minor: 'bani' },
				RUB: { format: Ki.threecommadecimal, minor: 'kopeck', minimum: 130 },
				RWF: { decimals: 0, major: 'franc', minor: 'centime' },
				SAR: { minor: 'halalat', minimum: 10 },
				SBD: { minor: 'cent' },
				SCR: { minor: 'cent', minimum: 28 },
				SEK: { format: Ki.threespacecommadecimal, minimum: 300, minor: 'öre' },
				SGD: { minimum: 50, minor: 'cent' },
				SHP: { minor: 'new pence' },
				SLL: { minor: 'cent', minimum: 1e3 },
				SOS: { minor: 'centesimi', minimum: 1e3 },
				SRD: { minor: 'cent' },
				STD: { minor: 'centimo' },
				SSP: { minor: 'piaster' },
				SVC: { minor: 'centavo', minimum: 18 },
				SYP: { minor: 'piaster' },
				SZL: { format: Ki.szl, minor: 'cent', minimum: 29 },
				THB: { minor: 'satang', minimum: 64 },
				TJS: { minor: 'diram' },
				TMT: { minor: 'tenga' },
				TND: { decimals: 3, minor: 'millime' },
				TOP: { minor: 'seniti' },
				TRY: { minor: 'kurus' },
				TTD: { minor: 'cent', minimum: 14 },
				TWD: { minor: 'cent' },
				TZS: { minor: 'cent', minimum: 1e3 },
				UAH: { format: Ki.threespacecommadecimal, minor: 'kopiyka' },
				UGX: { minor: 'cent' },
				USD: { minimum: 50, minor: 'cent' },
				UYU: { format: Ki.threecommadecimal, minor: 'centé', minimum: 67 },
				UZS: { minor: 'tiyin', minimum: 1e3 },
				VND: { format: Ki.none, minor: 'hao,xu' },
				VUV: { decimals: 0, major: 'vatu', minor: 'centime' },
				WST: { minor: 'sene' },
				XAF: { decimals: 0, major: 'franc', minor: 'centime' },
				XCD: { minor: 'cent' },
				XPF: { decimals: 0, major: 'franc', minor: 'centime' },
				YER: { minor: 'fil', minimum: 501 },
				ZAR: { format: Ki.threespaceseparator, minor: 'cent', minimum: 29 },
				ZMK: { minor: 'ngwee' }
			},
			Ni = function(n) {
				return Li[n] ? Li[n] : Li.default;
			},
			Bi = [
				'AED',
				'ALL',
				'AMD',
				'ARS',
				'AUD',
				'AWG',
				'BBD',
				'BDT',
				'BMD',
				'BND',
				'BOB',
				'BSD',
				'BWP',
				'BZD',
				'CAD',
				'CHF',
				'CNY',
				'COP',
				'CRC',
				'CUP',
				'CZK',
				'DKK',
				'DOP',
				'DZD',
				'EGP',
				'ETB',
				'EUR',
				'FJD',
				'GBP',
				'GIP',
				'GMD',
				'GTQ',
				'GYD',
				'HKD',
				'HNL',
				'HRK',
				'HTG',
				'HUF',
				'IDR',
				'ILS',
				'INR',
				'JMD',
				'KES',
				'KGS',
				'KHR',
				'KYD',
				'KZT',
				'LAK',
				'LBP',
				'LKR',
				'LRD',
				'LSL',
				'MAD',
				'MDL',
				'MKD',
				'MMK',
				'MNT',
				'MOP',
				'MUR',
				'MVR',
				'MWK',
				'MXN',
				'MYR',
				'NAD',
				'NGN',
				'NIO',
				'NOK',
				'NPR',
				'NZD',
				'PEN',
				'PGK',
				'PHP',
				'PKR',
				'QAR',
				'RUB',
				'SAR',
				'SCR',
				'SEK',
				'SGD',
				'SLL',
				'SOS',
				'SSP',
				'SVC',
				'SZL',
				'THB',
				'TTD',
				'TZS',
				'USD',
				'UYU',
				'UZS',
				'YER',
				'ZAR'
			],
			Ai = {
				AED: 'د.إ',
				AFN: '&#x60b;',
				ALL: 'Lek',
				AMD: '֏',
				ANG: 'ƒ',
				AOA: 'Kz',
				ARS: '$',
				AUD: '$',
				AWG: 'ƒ',
				AZN: 'ман',
				BAM: 'KM',
				BBD: '$',
				BDT: '৳',
				BGN: 'лв',
				BHD: 'د.ب',
				BIF: 'FBu',
				BMD: '$',
				BND: 'B$',
				BOB: 'Bs.',
				BRL: 'R$',
				BSD: 'B$',
				BTN: 'Nu.',
				BWP: 'P',
				BYR: 'Br',
				BZD: 'BZ$',
				CAD: 'C$',
				CDF: 'FC',
				CHF: 'F',
				CLP: '$',
				CNY: '¥',
				COP: '$',
				CRC: '₡',
				CUC: '&#x20b1;',
				CUP: '$',
				CVE: 'Esc',
				CZK: 'Kč',
				DJF: 'Fdj',
				DKK: 'kr',
				DOP: '$',
				DZD: 'د.ج',
				EGP: '£',
				ERN: 'Nfa',
				ETB: 'ብር',
				EUR: '€',
				FJD: 'FJ$',
				FKP: 'FK&#163;',
				GBP: '£',
				GEL: 'ლ',
				GHS: '&#x20b5;',
				GIP: '£',
				GMD: 'D',
				GNF: 'FG',
				GTQ: 'Q',
				GYD: 'G$',
				HKD: 'HK$',
				HNL: 'L',
				HRK: 'kn',
				HTG: 'G',
				HUF: 'Ft',
				IDR: 'Rp',
				ILS: '₪',
				INR: '₹',
				IQD: 'ع.د',
				IRR: '&#xfdfc;',
				ISK: 'Kr',
				JMD: '$',
				JOD: 'د.ا',
				JPY: '&#165;',
				KES: 'Ksh',
				KGS: 'Лв',
				KHR: '៛',
				KMF: 'CF',
				KPW: '₩',
				KRW: '₩',
				KWD: 'د.ك',
				KYD: '$',
				KZT: '₸',
				LAK: '₭',
				LBP: '&#1604;.&#1604;.',
				LD: 'ل.د',
				LKR: 'රු',
				LRD: 'L$',
				LSL: 'L',
				LTL: 'Lt',
				LVL: 'Ls',
				LYD: 'ل.د',
				MAD: 'د.م.',
				MDL: 'L',
				MGA: 'Ar',
				MKD: 'ден',
				MMK: 'K',
				MNT: '₮',
				MOP: 'P',
				MRO: 'UM',
				MUR: 'Ɍs',
				MVR: 'Rf',
				MWK: 'MK',
				MXN: 'Mex$',
				MYR: 'RM',
				MZN: 'MT',
				NAD: 'N$',
				NGN: '₦',
				NIO: 'C$',
				NOK: 'kr',
				NPR: 'रू',
				NZD: '$',
				OMR: 'ر.ع.',
				PAB: 'B/.',
				PEN: 'S/',
				PGK: 'K',
				PHP: '₱',
				PKR: 'Ɍs',
				PLN: 'Zł',
				PYG: '&#x20b2;',
				QAR: 'QR',
				RON: 'L',
				RSD: 'Дин.',
				RUB: '₽',
				RWF: 'RF',
				SAR: 'SR',
				SBD: 'SI$',
				SCR: 'SRe',
				SDG: '&#163;Sd',
				SEK: 'kr',
				SFR: 'Fr',
				SGD: 'S$',
				SHP: '&#163;',
				SLL: 'Le',
				SOS: 'Sh.so.',
				SRD: '$',
				SSP: '£',
				STD: 'Db',
				SVC: '$',
				SYP: 'S&#163;',
				SZL: 'L',
				THB: '฿',
				TJS: 'SM',
				TMT: 'M',
				TND: 'د.ت',
				TOP: 'T$',
				TRY: 'TL',
				TTD: '$',
				TWD: 'NT$',
				TZS: 'Sh',
				UAH: '&#x20b4;',
				UGX: 'USh',
				USD: '$',
				UYU: '$',
				UZS: "so'm",
				VEF: 'Bs',
				VND: '&#x20ab;',
				VUV: 'VT',
				WST: 'T',
				XAF: 'CFA',
				XCD: 'EC$',
				XOF: 'CFA',
				XPF: 'F',
				YER: '﷼',
				ZAR: 'R',
				ZMK: 'ZK',
				ZWL: 'Z$'
			};
		(wi = {}),
			Mn((ki = Pi), function(n, e) {
				(Pi[e] = n),
					(Li[e] = Li[e] || {}),
					ki[e].min_value && (Li[e].minimum = ki[e].min_value),
					ki[e].denomination && (Li[e].decimals = d.LOG10E * d.log(ki[e].denomination)),
					(wi[e] = ki[e].symbol);
			}),
			Ln(Ai, wi),
			Si(wi),
			Si(Ai);
		vn(
			Bi,
			function(n, e) {
				return (n[e] = Ai[e]), n;
			},
			{}
		);
		function Ti(n, e, i) {
			return (
				void 0 === i && (i = !0),
				[
					Ai[e],
					((t = n), (a = Ni(e)), (o = t / d.pow(10, a.decimals)), a.format(o.toFixed(a.decimals), a.decimals))
				].join(i ? ' ' : '')
			);
			var t, a, o;
		}
		function Ci(n) {
			return void 0 === n && (n = ''), bi.api + bi.version + n;
		}
		var xi = [
			'key',
			'order_id',
			'invoice_id',
			'subscription_id',
			'auth_link_id',
			'payment_link_id',
			'contact_id',
			'checkout_config_id'
		];
		function Ei(e) {
			if (!E(this, Ei)) return new Ei(e);
			var i;
			Xe.call(this), (this.id = We.makeUid()), Qe.setR(this);
			try {
				(i = (function(n) {
					(n && 'object' == typeof n) || O('Invalid options');
					var e = new fi(n);
					return (
						(function(t, a) {
							void 0 === a && (a = []);
							var o = !0;
							(t = t.get()),
								Mn(Fi, function(n, e) {
									var i;
									fn(a, e) ||
										(e in t &&
											((i = n(t[e], t)) && ((o = !1), O('Invalid ' + e + ' (' + i + ')'))));
								});
						})(e, [ 'amount' ]),
						(function(n) {
							var i = n.get('notes');
							Mn(i, function(n, e) {
								P(n) ? 254 < n.length && (i[e] = n.slice(0, 254)) : M(n) || w(n) || delete i[e];
							});
						})(e),
						e
					);
				})(e)),
					(this.get = i.get),
					(this.set = i.set);
			} catch (n) {
				var t = n.message;
				(this.get && this.isLiveMode()) || (B(e) && !e.parent && l.alert(t)), O(t);
			}
			xi.every(function(n) {
				return !i.get(n);
			}) && O('No key passed'),
				this.postInit();
		}
		var Gi = (Ei.prototype = new Xe());
		function $i(n, e) {
			return be.jsonp({ url: Ci('preferences'), data: n, callback: e });
		}
		(Gi.postInit = pn),
			(Gi.onNew = function(n, e) {
				var i = this;
				'ready' === n &&
					(this.prefs
						? e(n, this.prefs)
						: $i(zi(this), function(n) {
								n.methods && ((i.prefs = n), (i.methods = n.methods)), e(i.prefs, n);
							}));
			}),
			(Gi.emi_calculator = function(n, e) {
				return Ei.emi.calculator(this.get('amount') / 100, n, e);
			}),
			(Ei.emi = {
				calculator: function(n, e, i) {
					if (!i) return d.ceil(n / e);
					i /= 1200;
					var t = d.pow(1 + i, e);
					return f(n * i * t / (t - 1), 10);
				}
			});
		Ei.payment = {
			getMethods: function(e) {
				return $i({ key_id: Ei.defaults.key }, function(n) {
					e(n.methods || n);
				});
			},
			getPrefs: function(e, i) {
				var t,
					a = ((t = G()),
					function(n) {
						return G() - t;
					});
				return (
					Qe.track('prefs:start', { type: 'metric' }),
					be({
						url: I(Ci('preferences'), e),
						callback: function(n) {
							if (
								(Qe.track('prefs:end', { type: 'metric', data: { time: a() } }),
								n.xhr && 0 === n.xhr.status)
							)
								return $i(e, i);
							i(n);
						}
					})
				);
			}
		};
		function zi(n) {
			if (n) {
				var i = n.get,
					t = {},
					e = i('key');
				e && (t.key_id = e);
				var a = [ i('currency') ],
					o = i('display_currency'),
					r = i('display_amount');
				return (
					o && ('' + r).length && a.push(o),
					(t.currency = a),
					sn(
						[
							'order_id',
							'customer_id',
							'invoice_id',
							'payment_link_id',
							'subscription_id',
							'auth_link_id',
							'recurring',
							'subscription_card_change',
							'account_id',
							'contact_id',
							'checkout_config_id'
						],
						function(n) {
							var e = i(n);
							e && (t[n] = e);
						}
					),
					t
				);
			}
		}
		(Gi.isLiveMode = function() {
			var n = this.preferences;
			return (!n && /^rzp_l/.test(this.get('key'))) || (n && 'live' === n.mode);
		}),
			(Gi.calculateFees = function(n) {
				var t = this;
				return new Ne(function(e, i) {
					(n = gi(n, t)),
						be.post({
							url: Ci('payments/calculate/fees'),
							data: n,
							callback: function(n) {
								return (n.error ? i : e)(n);
							}
						});
				});
			});
		var Fi = {
			notes: function(n) {
				if (B(n) && 15 < C(Z(n))) return 'At most 15 notes are allowed';
			},
			amount: function(n, e) {
				var i,
					t,
					a = e.display_currency || e.currency || 'INR',
					o = Ni(a),
					r = o.minimum,
					m = '';
				if (
					(o.decimals && o.minor ? (m = ' ' + o.minor) : o.major && (m = ' ' + o.major),
					void 0 === (t = r) && (t = 100),
					(/[^0-9]/.test((i = n)) || !(t <= (i = f(i, 10)))) && !e.recurring)
				)
					return 'should be passed in integer' + m + '. Minimum value is ' + r + m + ', i.e. ' + Ti(r, a);
			},
			currency: function(n) {
				if (!fn(Bi, n)) return 'The provided currency is not currently supported';
			},
			display_currency: function(n) {
				if (!(n in Ai) && n !== Ei.defaults.display_currency) return 'This display currency is not supported';
			},
			display_amount: function(n) {
				if (!(n = r(n).replace(/([^0-9.])/g, '')) && n !== Ei.defaults.display_amount) return '';
			},
			payout: function(n, e) {
				if (n) {
					if (!e.key) return 'key is required for a Payout';
					if (!e.contact_id) return 'contact_id is required for a Payout';
				}
			}
		};
		(Ei.configure = function(n) {
			Mn(si(n, ui), function(n, e) {
				typeof ui[e] == typeof n && (ui[e] = n);
			});
		}),
			(Ei.defaults = ui),
			(l.Razorpay = Ei),
			(ui.timeout = 0),
			(ui.name = ''),
			(ui.partnership_logo = ''),
			(ui.nativeotp = !0),
			(ui.remember_customer = !1),
			(ui.personalization = !1),
			(ui.paused = !1),
			(ui.fee_label = 'Gateway Charges'),
			(ui.min_amount_label = ''),
			(ui.partial_payment = {
				min_amount_label: 'Minimum first amount',
				full_amount_label: 'Pay in full',
				partial_amount_label: 'Make payment in parts',
				partial_amount_description: 'Pay some now and the remaining later',
				select_partial: !1
			}),
			(ui.method = {
				netbanking: null,
				card: !0,
				cardless_emi: null,
				wallet: null,
				emi: !0,
				upi: null,
				upi_intent: !0,
				qr: !0,
				bank_transfer: !0
			}),
			(ui.prefill = {
				amount: '',
				wallet: '',
				provider: '',
				method: '',
				name: '',
				contact: '',
				email: '',
				vpa: '',
				'card[number]': '',
				'card[expiry]': '',
				'card[cvv]': '',
				bank: '',
				'bank_account[name]': '',
				'bank_account[account_number]': '',
				'bank_account[account_type]': '',
				'bank_account[ifsc]': '',
				auth_type: ''
			}),
			(ui.features = { cardsaving: !0 }),
			(ui.readonly = { contact: !1, email: !1, name: !1 }),
			(ui.hidden = { contact: !1, email: !1 }),
			(ui.modal = {
				confirm_close: !1,
				ondismiss: pn,
				onhidden: pn,
				escape: !0,
				animation: !0,
				backdropclose: !1,
				handleback: !0
			}),
			(ui.external = {
				wallets: [ 'amazonpay' ],
				handler: function(data) {
					console.log(data);
				}
			}),
			(ui.theme = {
				upi_only: !1,
				color: '',
				backdrop_color: 'rgba(0,0,0,0.6)',
				image_padding: !0,
				image_frame: !0,
				close_button: !0,
				close_method_back: !1,
				hide_topbar: !1,
				branding: '',
				debit_card: !1
			}),
			(ui._ = { integration: null, integration_version: null, integration_parent_version: null }),
			(ui.config = { display: {} });
		var Oi,
			Hi,
			Ui,
			Ii,
			Zi = l.screen,
			Yi = l.scrollTo,
			ji = ai,
			Wi = {
				overflow: '',
				metas: null,
				orientationchange: function() {
					Wi.resize.call(this), Wi.scroll.call(this);
				},
				resize: function() {
					var n = l.innerHeight || Zi.height;
					(Ji.container.style.position = n < 450 ? 'absolute' : 'fixed'),
						(this.el.style.height = d.max(n, 460) + 'px');
				},
				scroll: function() {
					var n;
					'number' == typeof l.pageYOffset &&
						(l.innerHeight < 460
							? ((n = 460 - l.innerHeight), l.pageYOffset > 120 + n && le(n))
							: this.isFocused || le(0));
				}
			};
		function qi() {
			return Wi.metas || (Wi.metas = me('head meta[name=viewport],head meta[name="theme-color"]')), Wi.metas;
		}
		function Vi(n) {
			try {
				Ji.backdrop.style.background = n;
			} catch (n) {}
		}
		function Ji(n) {
			if (((Oi = c.body), (Hi = c.head), (Ui = Oi.style), n)) return this.getEl(n), this.openRzp(n);
			this.getEl(), (this.time = G());
		}
		Ji.prototype = {
			getEl: function(n) {
				var e, i, t, a, o, r;
				return (
					this.el ||
						((i = {
							style:
								'opacity: 1; height: 100%; position: relative; background: none; display: block; border: 0 none transparent; margin: 0px; padding: 0px; z-index: 2;',
							allowtransparency: !0,
							frameborder: 0,
							width: '100%',
							height: '100%',
							allowpaymentrequest: !0,
							src: ((t = n),
							(o = bi.frame),
							(r = $() < 0.25),
							o ||
								((o = Ci('checkout')),
								(a = zi(t)) ? (o = I(o, a)) : ((o += '/public'), r && (o += '/canary'))),
							r && (o = I(o, { canary: 1 })),
							o),
							class: 'razorpay-checkout-frame'
						}),
						(this.el = ((e = Bn('iframe')), In(i)(e)))),
					this.el
				);
			},
			openRzp: function(n) {
				var e,
					i,
					t,
					a,
					o,
					r = ((e = this.el), Zn({ width: '100%', height: '100%' })(e)),
					m = n.get('parent'),
					u = (m = m && W(m)) || Ji.container;
				!(function(n, e) {
					if (!Ii)
						try {
							var i;
							(Ii = c.createElement('div')).className = 'razorpay-loader';
							var t =
								'margin:-25px 0 0 -25px;height:50px;width:50px;animation:rzp-rot 1s infinite linear;-webkit-animation:rzp-rot 1s infinite linear;border: 1px solid rgba(255, 255, 255, 0.2);border-top-color: rgba(255, 255, 255, 0.7);border-radius: 50%;';
							(t += e
								? 'margin: 100px auto -150px;border: 1px solid rgba(0, 0, 0, 0.2);border-top-color: rgba(0, 0, 0, 0.7);'
								: 'position:absolute;left:50%;top:50%;'),
								Ii.setAttribute('style', t),
								(i = Ii),
								$n(n)(i);
						} catch (n) {}
				})(u, m),
					n !== this.rzp && (An(r) !== u && ((i = u), zn(r)(i)), (this.rzp = n)),
					m
						? ((t = r), Un('minHeight', '530px')(t), (this.embedded = !0))
						: ((a = u),
							(o = Un('display', 'block')(a)),
							Wn(o),
							Vi(n.get('theme.backdrop_color')),
							/^rzp_t/.test(n.get('key')) && Ji.ribbon && (Ji.ribbon.style.opacity = 1),
							this.setMetaAndOverflow()),
					this.bind(),
					this.onload();
			},
			makeMessage: function() {
				var n = this.rzp,
					i = n.get(),
					e = { integration: We.props.integration, referer: b.href, options: i, id: n.id };
				return (
					n.metadata && (e.metadata = n.metadata),
					Mn(n.modal.options, function(n, e) {
						i['modal.' + e] = n;
					}),
					this.embedded && (delete i.parent, (e.embedded = !0)),
					(function(n) {
						var e,
							i,
							t = n.image;
						if (t && P(t)) {
							if (H(t)) return;
							t.indexOf('http') &&
								((e = b.protocol + '//' + b.hostname + (b.port ? ':' + b.port : '')),
								(i = ''),
								'/' !== t[0] && '/' !== (i += b.pathname.replace(/[^/]*$/g, ''))[0] && (i = '/' + i),
								(n.image = e + i + t));
						}
					})(i),
					e
				);
			},
			close: function() {
				Vi(''),
					Ji.ribbon && (Ji.ribbon.style.opacity = 0),
					(function(n) {
						n && sn(n, Fn);
						var e = qi();
						e && sn(e, $n(Hi));
					})(this.$metas),
					(Ui.overflow = Wi.overflow),
					this.unbind(),
					ji && Yi(0, Wi.oldY),
					We.flush();
			},
			bind: function() {
				var n,
					t = this;
				this.listeners ||
					((this.listeners = []),
					(n = {}),
					ji &&
						((n.orientationchange = Wi.orientationchange),
						this.rzp.get('parent') || (n.resize = Wi.resize)),
					Mn(n, function(n, e) {
						var i;
						t.listeners.push(((i = window), j(e, _n(n, t))(i)));
					}));
			},
			unbind: function() {
				var n = this.listeners;
				sn(n, function(n) {
					return n();
				}),
					(this.listeners = null);
			},
			setMetaAndOverflow: function() {
				var n, e;
				Hi &&
					(sn(qi(), function(n) {
						return Fn(n);
					}),
					(this.$metas = [
						((n = Bn('meta')),
						In({
							name: 'viewport',
							content: 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'
						})(n)),
						((e = Bn('meta')), In({ name: 'theme-color', content: this.rzp.get('theme.color') })(e))
					]),
					sn(this.$metas, $n(Hi)),
					(Wi.overflow = Ui.overflow),
					(Ui.overflow = 'hidden'),
					ji && ((Wi.oldY = l.pageYOffset), l.scrollTo(0, 0), Wi.orientationchange.call(this)));
			},
			postMessage: function(n) {
				(n.id = this.rzp.id), (n = Pn(n)), this.el.contentWindow.postMessage(n, '*');
			},
			onmessage: function(n) {
				var e,
					i,
					t = Kn(n.data);
				t &&
					((e = t.event),
					(i = this.rzp),
					n.origin &&
						'frame' === t.source &&
						n.source === this.el.contentWindow &&
						((t = t.data),
						this['on' + e](t),
						('dismiss' !== e && 'fault' !== e) || Qe.track(e, { data: t, r: i, immediately: !0 })));
			},
			onload: function() {
				this.rzp && this.postMessage(this.makeMessage());
			},
			onfocus: function() {
				this.isFocused = !0;
			},
			onblur: function() {
				(this.isFocused = !1), Wi.orientationchange.call(this);
			},
			onrender: function() {
				Ii && (Fn(Ii), (Ii = null)), this.rzp.emit('render');
			},
			onevent: function(n) {
				this.rzp.emit(n.event, n.data);
			},
			onredirect: function(n) {
				We.flush(),
					(function(n) {
						if (!n.target && l !== l.parent) return l.Razorpay.sendMessage({ event: 'redirect', data: n });
						ue(n.url, n.content, n.method, n.target);
					})(n);
			},
			onsubmit: function(e) {
				We.flush();
				var i = this.rzp;
				'wallet' === e.method &&
					sn(i.get('external.wallets'), function(n) {
						if (n === e.wallet)
							try {
								i.get('external.handler').call(i, e);
							} catch (n) {}
					}),
					i.emit('payment.submit', { method: e.method });
			},
			ondismiss: function(n) {
				this.close();
				var e = this.rzp.get('modal.ondismiss');
				K(e) &&
					a(function() {
						return e(n);
					});
			},
			onhidden: function() {
				We.flush(), this.afterClose();
				var n = this.rzp.get('modal.onhidden');
				K(n) && n();
			},
			oncomplete: function(n) {
				this.close();
				var e = this.rzp,
					i = e.get('handler');
				Qe.track('checkout_success', { r: e, data: n, immediately: !0 }),
					K(i) &&
						a(function() {
							i.call(e, n);
						}, 200);
			},
			onpaymenterror: function(n) {
				We.flush();
				try {
					this.rzp.emit('payment.error', n), this.rzp.emit('payment.failed', n);
				} catch (n) {}
			},
			onfailure: function(n) {
				this.ondismiss(), l.alert('Payment Failed.\n' + n.error.description), this.onhidden();
			},
			onfault: function(n) {
				var e = 'Something went wrong.';
				P(n) ? (e = n) : L(n) && (n.message || n.description) && (e = n.message || n.description),
					We.flush(),
					this.rzp.close();
				var i = this.rzp.get('callback_url');
				(this.rzp.get('redirect') || ri) && i
					? ue(i, { error: n }, 'post')
					: l.alert('Oops! Something went wrong.\n' + e),
					this.afterClose();
			},
			afterClose: function() {
				Ji.container.style.display = 'none';
			},
			onflush: function() {
				We.flush();
			}
		};
		var Qi,
			Xi = x(Ei);
		function nt(e) {
			return function n() {
				return Qi ? e.call(this) : (a(_n(n, this), 99), this);
			};
		}
		!(function n() {
			(Qi = c.body || c.getElementsByTagName('body')[0]) || a(n, 99);
		})();
		var et,
			it = c.currentScript || (et = me('script'))[et.length - 1];
		function tt(n) {
			var e,
				i = An(it),
				t = zn(((e = Bn()), Yn(ce(n))(e)))(i),
				a = Sn('onsubmit', pn)(t);
			On(a);
		}
		function at(m) {
			var n,
				e = An(it),
				i = zn(
					((n = Bn('input')),
					Ln({ type: 'submit', value: m.get('buttontext'), className: 'razorpay-payment-button' })(n))
				)(e);
			Sn('onsubmit', function(n) {
				n.preventDefault();
				var e = this.action,
					i = this.method,
					t = this.target,
					a = m.get();
				if (P(e) && e && !a.callback_url) {
					var o = {
						url: e,
						content: vn(
							this.querySelectorAll('[name]'),
							function(n, e) {
								return (n[e.name] = e.value), n;
							},
							{}
						),
						method: P(i) ? i : 'get',
						target: P(t) && t
					};
					try {
						var r = v(Pn({ request: o, options: Pn(a), back: b.href }));
						a.callback_url = Ci('checkout/onyx') + '?data=' + r;
					} catch (n) {}
				}
				return m.open(), !1;
			})(i);
		}
		var ot, rt;
		function mt() {
			var n, e, i, t, a, o, r, m, u, c, l, s, d, f, h, v;
			return (
				ot ||
					((n = Bn()),
					(e = Sn('className', 'razorpay-container')(n)),
					(i = Sn(
						'innerHTML',
						'<style>@keyframes rzp-rot{to{transform: rotate(360deg);}}@-webkit-keyframes rzp-rot{to{-webkit-transform: rotate(360deg);}}</style>'
					)(e)),
					(t = Zn({
						zIndex: 1e9,
						position: 'fixed',
						top: 0,
						display: 'none',
						left: 0,
						height: '100%',
						width: '100%',
						'-webkit-overflow-scrolling': 'touch',
						'-webkit-backface-visibility': 'hidden',
						'overflow-y': 'visible'
					})(i)),
					(ot = $n(Qi)(t)),
					(d = Ji.container = ot),
					(v = Bn()),
					(h = Sn('className', 'razorpay-backdrop')(v)),
					(f = Zn({
						'min-height': '100%',
						transition: '0.3s ease-out',
						position: 'fixed',
						top: 0,
						left: 0,
						width: '100%',
						height: '100%'
					})(h)),
					(a = $n(d)(f)),
					(r = Ji.backdrop = a),
					(l = 'rotate(45deg)'),
					(s = 'opacity 0.3s ease-in'),
					(c = Bn('span')),
					(u = Sn('innerHTML', 'Test Mode')(c)),
					(m = Zn({
						'text-decoration': 'none',
						background: '#D64444',
						border: '1px dashed white',
						padding: '3px',
						opacity: '0',
						'-webkit-transform': l,
						'-moz-transform': l,
						'-ms-transform': l,
						'-o-transform': l,
						transform: l,
						'-webkit-transition': s,
						'-moz-transition': s,
						transition: s,
						'font-family': 'lato,ubuntu,helvetica,sans-serif',
						color: 'white',
						position: 'absolute',
						width: '200px',
						'text-align': 'center',
						right: '-50px',
						top: '50px'
					})(u)),
					(o = $n(r)(m)),
					(Ji.ribbon = o)),
				ot
			);
		}
		function ut(n) {
			var e, i;
			return (
				rt
					? rt.openRzp(n)
					: ((rt = new Ji(n)), (e = l), j('message', _n('onmessage', rt))(e), (i = ot), zn(rt.el)(i)),
				rt
			);
		}
		(Ei.open = function(n) {
			return Ei(n).open();
		}),
			(Xi.postInit = function() {
				(this.modal = { options: {} }), this.get('parent') && this.open();
			});
		var ct = Xi.onNew;
		(Xi.onNew = function(n, e) {
			'payment.error' === n && We(this, 'event_paymenterror', b.href), K(ct) && ct.call(this, n, e);
		}),
			(Xi.open = nt(function() {
				this.metadata || (this.metadata = {}), (this.metadata.openedAt = u.now());
				var n = (this.checkoutFrame = ut(this));
				return (
					We(this, 'open'),
					n.el.contentWindow ||
						(n.close(),
						n.afterClose(),
						l.alert('This browser is not supported.\nPlease try payment in another browser.')),
					'-new.js' === it.src.slice(-7) && We(this, 'oldscript', b.href),
					this
				);
			})),
			(Xi.resume = function(n) {
				var e = this.checkoutFrame;
				e && e.postMessage({ event: 'resume', data: n });
			}),
			(Xi.close = function() {
				var n = this.checkoutFrame;
				n && n.postMessage({ event: 'close' });
			});
		var lt = nt(function() {
			mt(), (rt = ut());
			try {
				!(function() {
					var a = {};
					Mn(it.attributes, function(n) {
						var e,
							i,
							t = n.name.toLowerCase();
						/^data-/.test(t) &&
							((e = a),
							(t = t.replace(/^data-/, '')),
							'true' === (i = n.value) ? (i = !0) : 'false' === i && (i = !1),
							/^notes\./.test(t) &&
								(a.notes || (a.notes = {}), (e = a.notes), (t = t.replace(/^notes\./, ''))),
							(e[t] = i));
					});
					var n,
						e = a.key;
					e && 0 < e.length && ((a.handler = tt), (n = Ei(a)), a.parent || at(n));
				})();
			} catch (n) {}
		});
		(We.props.library = 'checkoutjs'),
			(ui.handler = function(n) {
				var e;
				!E(this, Ei) || ((e = this.get('callback_url')) && ue(e, n, 'post'));
			}),
			(ui.buttontext = 'Pay Now'),
			(ui.parent = null),
			(Fi.parent = function(n) {
				if (!W(n)) return "parent provided for embedded mode doesn't exist";
			}),
			lt();
	})();
})();
