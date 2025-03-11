(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = typeof globalThis !== 'undefined' ? globalThis : global || self, global.bootstrap = factory());
  })(this, (function () { 'use strict';
  
  
    const MAX_UID = 1000000;
    const MILLISECONDS_MULTIPLIER = 1000;
    const TRANSITION_END = 'transitionend'; // Shout-out Angus Croll (https://goo.gl/pxwQGp)
  
    const toType = object => {
      if (object === null || object === undefined) {
        return `${object}`;
      }
  
      return Object.prototype.toString.call(object).match(/\s([a-z]+)/i)[1].toLowerCase();
    };
    /**
     * Public Util API
     */
  
  
    const getUID = prefix => {
      do {
        prefix += Math.floor(Math.random() * MAX_UID);
      } while (document.getElementById(prefix));
  
      return prefix;
    };
  
    const getSelector = element => {
      let selector = element.getAttribute('data-bs-target');
  
      if (!selector || selector === '#') {
        let hrefAttribute = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
        // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
        // `document.querySelector` will rightfully complain it is invalid.
        // See https://github.com/twbs/bootstrap/issues/32273
  
        if (!hrefAttribute || !hrefAttribute.includes('#') && !hrefAttribute.startsWith('.')) {
          return null;
        } // Just in case some CMS puts out a full URL with the anchor appended
  
  
        if (hrefAttribute.includes('#') && !hrefAttribute.startsWith('#')) {
          hrefAttribute = `#${hrefAttribute.split('#')[1]}`;
        }
  
        selector = hrefAttribute && hrefAttribute !== '#' ? hrefAttribute.trim() : null;
      }
  
      return selector;
    };
  
    const getSelectorFromElement = element => {
      const selector = getSelector(element);
  
      if (selector) {
        return document.querySelector(selector) ? selector : null;
      }
  
      return null;
    };
  
    const getElementFromSelector = element => {
      const selector = getSelector(element);
      return selector ? document.querySelector(selector) : null;
    };
  
    const getTransitionDurationFromElement = element => {
      if (!element) {
        return 0;
      } // Get transition-duration of the element
  
  
      let {
        transitionDuration,
        transitionDelay
      } = window.getComputedStyle(element);
      const floatTransitionDuration = Number.parseFloat(transitionDuration);
      const floatTransitionDelay = Number.parseFloat(transitionDelay); // Return 0 if element or transition duration is not found
  
      if (!floatTransitionDuration && !floatTransitionDelay) {
        return 0;
      } // If multiple durations are defined, take the first
  
  
      transitionDuration = transitionDuration.split(',')[0];
      transitionDelay = transitionDelay.split(',')[0];
      return (Number.parseFloat(transitionDuration) + Number.parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER;
    };
  
    const triggerTransitionEnd = element => {
      element.dispatchEvent(new Event(TRANSITION_END));
    };
  
    const isElement$1 = object => {
      if (!object || typeof object !== 'object') {
        return false;
      }
  
      if (typeof object.jquery !== 'undefined') {
        object = object[0];
      }
  
      return typeof object.nodeType !== 'undefined';
    };
  
    const getElement = object => {
      // it's a jQuery object or a node element
      if (isElement$1(object)) {
        return object.jquery ? object[0] : object;
      }
  
      if (typeof object === 'string' && object.length > 0) {
        return document.querySelector(object);
      }
  
      return null;
    };
  
    const isVisible = element => {
      if (!isElement$1(element) || element.getClientRects().length === 0) {
        return false;
      }
  
      const elementIsVisible = getComputedStyle(element).getPropertyValue('visibility') === 'visible'; // Handle `details` element as its content may falsie appear visible when it is closed
  
      const closedDetails = element.closest('details:not([open])');
  
      if (!closedDetails) {
        return elementIsVisible;
      }
  
      if (closedDetails !== element) {
        const summary = element.closest('summary');
  
        if (summary && summary.parentNode !== closedDetails) {
          return false;
        }
  
        if (summary === null) {
          return false;
        }
      }
  
      return elementIsVisible;
    };
  
    const isDisabled = element => {
      if (!element || element.nodeType !== Node.ELEMENT_NODE) {
        return true;
      }
  
      if (element.classList.contains('disabled')) {
        return true;
      }
  
      if (typeof element.disabled !== 'undefined') {
        return element.disabled;
      }
  
      return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
    };
  
    const findShadowRoot = element => {
      if (!document.documentElement.attachShadow) {
        return null;
      } // Can find the shadow root otherwise it'll return the document
  
  
      if (typeof element.getRootNode === 'function') {
        const root = element.getRootNode();
        return root instanceof ShadowRoot ? root : null;
      }
  
      if (element instanceof ShadowRoot) {
        return element;
      } // when we don't find a shadow root
  
  
      if (!element.parentNode) {
        return null;
      }
  
      return findShadowRoot(element.parentNode);
    };
  
    const noop = () => {};
    /**
     * Trick to restart an element's animation
     *
     * @param {HTMLElement} element
     * @return void
     *
     * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
     */
  
  
    const reflow = element => {
      element.offsetHeight; // eslint-disable-line no-unused-expressions
    };
  
    const getjQuery = () => {
      if (window.jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
        return window.jQuery;
      }
  
      return null;
    };
  
    const DOMContentLoadedCallbacks = [];
  
    const onDOMContentLoaded = callback => {
      if (document.readyState === 'loading') {
        // add listener on the first call when the document is in loading state
        if (!DOMContentLoadedCallbacks.length) {
          document.addEventListener('DOMContentLoaded', () => {
            for (const callback of DOMContentLoadedCallbacks) {
              callback();
            }
          });
        }
  
        DOMContentLoadedCallbacks.push(callback);
      } else {
        callback();
      }
    };
  
    const isRTL = () => document.documentElement.dir === 'rtl';
  
    const defineJQueryPlugin = plugin => {
      onDOMContentLoaded(() => {
        const $ = getjQuery();
        /* istanbul ignore if */
  
        if ($) {
          const name = plugin.NAME;
          const JQUERY_NO_CONFLICT = $.fn[name];
          $.fn[name] = plugin.jQueryInterface;
          $.fn[name].Constructor = plugin;
  
          $.fn[name].noConflict = () => {
            $.fn[name] = JQUERY_NO_CONFLICT;
            return plugin.jQueryInterface;
          };
        }
      });
    };
  
    const execute = callback => {
      if (typeof callback === 'function') {
        callback();
      }
    };
  
    const executeAfterTransition = (callback, transitionElement, waitForTransition = true) => {
      if (!waitForTransition) {
        execute(callback);
        return;
      }
  
      const durationPadding = 5;
      const emulatedDuration = getTransitionDurationFromElement(transitionElement) + durationPadding;
      let called = false;
  
      const handler = ({
        target
      }) => {
        if (target !== transitionElement) {
          return;
        }
  
        called = true;
        transitionElement.removeEventListener(TRANSITION_END, handler);
        execute(callback);
      };
  
      transitionElement.addEventListener(TRANSITION_END, handler);
      setTimeout(() => {
        if (!called) {
          triggerTransitionEnd(transitionElement);
        }
      }, emulatedDuration);
    };
    /**
     * Return the previous/next element of a list.
     *
     * @param {array} list    The list of elements
     * @param activeElement   The active element
     * @param shouldGetNext   Choose to get next or previous element
     * @param isCycleAllowed
     * @return {Element|elem} The proper element
     */
  
  
    const getNextActiveElement = (list, activeElement, shouldGetNext, isCycleAllowed) => {
      const listLength = list.length;
      let index = list.indexOf(activeElement); // if the element does not exist in the list return an element
      // depending on the direction and if cycle is allowed
  
      if (index === -1) {
        return !shouldGetNext && isCycleAllowed ? list[listLength - 1] : list[0];
      }
  
      index += shouldGetNext ? 1 : -1;
  
      if (isCycleAllowed) {
        index = (index + listLength) % listLength;
      }
  
      return list[Math.max(0, Math.min(index, listLength - 1))];
    };
  
    /**
     * --------------------------------------------------------------------------
     * Bootstrap (v5.2.3): dom/event-handler.js
     * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
     * --------------------------------------------------------------------------
     */
    /**
     * Constants
     */
  
    const namespaceRegex = /[^.]*(?=\..*)\.|.*/;
    const stripNameRegex = /\..*/;
    const stripUidRegex = /::\d+$/;
    const eventRegistry = {}; // Events storage
  
    let uidEvent = 1;
    const customEvents = {
      mouseenter: 'mouseover',
      mouseleave: 'mouseout'
    };
    const nativeEvents = new Set(['click', 'dblclick', 'mouseup', 'mousedown', 'contextmenu', 'mousewheel', 'DOMMouseScroll', 'mouseover', 'mouseout', 'mousemove', 'selectstart', 'selectend', 'keydown', 'keypress', 'keyup', 'orientationchange', 'touchstart', 'touchmove', 'touchend', 'touchcancel', 'pointerdown', 'pointermove', 'pointerup', 'pointerleave', 'pointercancel', 'gesturestart', 'gesturechange', 'gestureend', 'focus', 'blur', 'change', 'reset', 'select', 'submit', 'focusin', 'focusout', 'load', 'unload', 'beforeunload', 'resize', 'move', 'DOMContentLoaded', 'readystatechange', 'error', 'abort', 'scroll']);
    /**
     * Private methods
     */
  
    function makeEventUid(element, uid) {
      return uid && `${uid}::${uidEvent++}` || element.uidEvent || uidEvent++;
    }
  
    function getElementEvents(element) {
      const uid = makeEventUid(element);
      element.uidEvent = uid;
      eventRegistry[uid] = eventRegistry[uid] || {};
      return eventRegistry[uid];
    }
  
    function bootstrapHandler(element, fn) {
      return function handler(event) {
        hydrateObj(event, {
          delegateTarget: element
        });
  
        if (handler.oneOff) {
          EventHandler.off(element, event.type, fn);
        }
  
        return fn.apply(element, [event]);
      };
    }
  
    function bootstrapDelegationHandler(element, selector, fn) {
      return function handler(event) {
        const domElements = element.querySelectorAll(selector);
  
        for (let {
          target
        } = event; target && target !== this; target = target.parentNode) {
          for (const domElement of domElements) {
            if (domElement !== target) {
              continue;
            }
  
            hydrateObj(event, {
              delegateTarget: target
            });
  
            if (handler.oneOff) {
              EventHandler.off(element, event.type, selector, fn);
            }
  
            return fn.apply(target, [event]);
          }
        }
      };
    }
  
    function findHandler(events, callable, delegationSelector = null) {
      return Object.values(events).find(event => event.callable === callable && event.delegationSelector === delegationSelector);
    }
  
    function normalizeParameters(originalTypeEvent, handler, delegationFunction) {
      const isDelegated = typeof handler === 'string'; // todo: tooltip passes `false` instead of selector, so we need to check
  
      const callable = isDelegated ? delegationFunction : handler || delegationFunction;
      let typeEvent = getTypeEvent(originalTypeEvent);
  
      if (!nativeEvents.has(typeEvent)) {
        typeEvent = originalTypeEvent;
      }
  
      return [isDelegated, callable, typeEvent];
    }
  
    function addHandler(element, originalTypeEvent, handler, delegationFunction, oneOff) {
      if (typeof originalTypeEvent !== 'string' || !element) {
        return;
      }
  
      let [isDelegated, callable, typeEvent] = normalizeParameters(originalTypeEvent, handler, delegationFunction); // in case of mouseenter or mouseleave wrap the handler within a function that checks for its DOM position
      // this prevents the handler from being dispatched the same way as mouseover or mouseout does
  
      if (originalTypeEvent in customEvents) {
        const wrapFunction = fn => {
          return function (event) {
            if (!event.relatedTarget || event.relatedTarget !== event.delegateTarget && !event.delegateTarget.contains(event.relatedTarget)) {
              return fn.call(this, event);
            }
          };
        };
  
        callable = wrapFunction(callable);
      }
  
      const events = getElementEvents(element);
      const handlers = events[typeEvent] || (events[typeEvent] = {});
      const previousFunction = findHandler(handlers, callable, isDelegated ? handler : null);
  
      if (previousFunction) {
        previousFunction.oneOff = previousFunction.oneOff && oneOff;
        return;
      }
  
      const uid = makeEventUid(callable, originalTypeEvent.replace(namespaceRegex, ''));
      const fn = isDelegated ? bootstrapDelegationHandler(element, handler, callable) : bootstrapHandler(element, callable);
      fn.delegationSelector = isDelegated ? handler : null;
      fn.callable = callable;
      fn.oneOff = oneOff;
      fn.uidEvent = uid;
      handlers[uid] = fn;
      element.addEventListener(typeEvent, fn, isDelegated);
    }
  
    function removeHandler(element, events, typeEvent, handler, delegationSelector) {
      const fn = findHandler(events[typeEvent], handler, delegationSelector);
  
      if (!fn) {
        return;
      }
  
      element.removeEventListener(typeEvent, fn, Boolean(delegationSelector));
      delete events[typeEvent][fn.uidEvent];
    }
  
    function removeNamespacedHandlers(element, events, typeEvent, namespace) {
      const storeElementEvent = events[typeEvent] || {};
  
      for (const handlerKey of Object.keys(storeElementEvent)) {
        if (handlerKey.includes(namespace)) {
          const event = storeElementEvent[handlerKey];
          removeHandler(element, events, typeEvent, event.callable, event.delegationSelector);
        }
      }
    }
  
    function getTypeEvent(event) {
      // allow to get the native events from namespaced events ('click.bs.button' --> 'click')
      event = event.replace(stripNameRegex, '');
      return customEvents[event] || event;
    }
  
    const EventHandler = {
      on(element, event, handler, delegationFunction) {
        addHandler(element, event, handler, delegationFunction, false);
      },
  
      one(element, event, handler, delegationFunction) {
        addHandler(element, event, handler, delegationFunction, true);
      },
  
      off(element, originalTypeEvent, handler, delegationFunction) {
        if (typeof originalTypeEvent !== 'string' || !element) {
          return;
        }
  
        const [isDelegated, callable, typeEvent] = normalizeParameters(originalTypeEvent, handler, delegationFunction);
        const inNamespace = typeEvent !== originalTypeEvent;
        const events = getElementEvents(element);
        const storeElementEvent = events[typeEvent] || {};
        const isNamespace = originalTypeEvent.startsWith('.');
  
        if (typeof callable !== 'undefined') {
          // Simplest case: handler is passed, remove that listener ONLY.
          if (!Object.keys(storeElementEvent).length) {
            return;
          }
  
          removeHandler(element, events, typeEvent, callable, isDelegated ? handler : null);
          return;
        }
  
        if (isNamespace) {
          for (const elementEvent of Object.keys(events)) {
            removeNamespacedHandlers(element, events, elementEvent, originalTypeEvent.slice(1));
          }
        }
  
        for (const keyHandlers of Object.keys(storeElementEvent)) {
          const handlerKey = keyHandlers.replace(stripUidRegex, '');
  
          if (!inNamespace || originalTypeEvent.includes(handlerKey)) {
            const event = storeElementEvent[keyHandlers];
            removeHandler(element, events, typeEvent, event.callable, event.delegationSelector);
          }
        }
      },
  
      trigger(element, event, args) {
        if (typeof event !== 'string' || !element) {
          return null;
        }
  
        const $ = getjQuery();
        const typeEvent = getTypeEvent(event);
        const inNamespace = event !== typeEvent;
        let jQueryEvent = null;
        let bubbles = true;
        let nativeDispatch = true;
        let defaultPrevented = false;
  
        if (inNamespace && $) {
          jQueryEvent = $.Event(event, args);
          $(element).trigger(jQueryEvent);
          bubbles = !jQueryEvent.isPropagationStopped();
          nativeDispatch = !jQueryEvent.isImmediatePropagationStopped();
          defaultPrevented = jQueryEvent.isDefaultPrevented();
        }
  
        let evt = new Event(event, {
          bubbles,
          cancelable: true
        });
        evt = hydrateObj(evt, args);
  
        if (defaultPrevented) {
          evt.preventDefault();
        }
  
        if (nativeDispatch) {
          element.dispatchEvent(evt);
        }
  
        if (evt.defaultPrevented && jQueryEvent) {
          jQueryEvent.preventDefault();
        }
  
        return evt;
      }
  
    };
  
    function hydrateObj(obj, meta) {
      for (const [key, value] of Object.entries(meta || {})) {
        try {
          obj[key] = value;
        } catch (_unused) {
          Object.defineProperty(obj, key, {
            configurable: true,
  
            get() {
              return value;
            }
  
          });
        }
      }
  
      return obj;
    }
  
    /**
     * --------------------------------------------------------------------------
     * Bootstrap (v5.2.3): dom/data.js
     * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
     * --------------------------------------------------------------------------
     */
  
    /**
     * Constants
     */
    const elementMap = new Map();
    const Data = {
      set(element, key, instance) {
        if (!elementMap.has(element)) {
          elementMap.set(element, new Map());
        }
  
        const instanceMap = elementMap.get(element); // make it clear we only want one instance per element
        // can be removed later when multiple key/instances are fine to be used
  
        if (!instanceMap.has(key) && instanceMap.size !== 0) {
          // eslint-disable-next-line no-console
          console.error(`Bootstrap doesn't allow more than one instance per element. Bound instance: ${Array.from(instanceMap.keys())[0]}.`);
          return;
        }
  
        instanceMap.set(key, instance);
      },
  
      get(element, key) {
        if (elementMap.has(element)) {
          return elementMap.get(element).get(key) || null;
        }
  
        return null;
      },
  
      remove(element, key) {
        if (!elementMap.has(element)) {
          return;
        }
  
        const instanceMap = elementMap.get(element);
        instanceMap.delete(key); // free up element references if there are no instances left for an element
  
        if (instanceMap.size === 0) {
          elementMap.delete(element);
        }
      }
  
    };
  
    /**
     * --------------------------------------------------------------------------
     * Bootstrap (v5.2.3): dom/manipulator.js
     * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
     * --------------------------------------------------------------------------
     */
    function normalizeData(value) {
      if (value === 'true') {
        return true;
      }
  
      if (value === 'false') {
        return false;
      }
  
      if (value === Number(value).toString()) {
        return Number(value);
      }
  
      if (value === '' || value === 'null') {
        return null;
      }
  
      if (typeof value !== 'string') {
        return value;
      }
  
      try {
        return JSON.parse(decodeURIComponent(value));
      } catch (_unused) {
        return value;
      }
    }
  
    function normalizeDataKey(key) {
      return key.replace(/[A-Z]/g, chr => `-${chr.toLowerCase()}`);
    }
  
    const Manipulator = {
      setDataAttribute(element, key, value) {
        element.setAttribute(`data-bs-${normalizeDataKey(key)}`, value);
      },
  
      removeDataAttribute(element, key) {
        element.removeAttribute(`data-bs-${normalizeDataKey(key)}`);
      },
  
      getDataAttributes(element) {
        if (!element) {
          return {};
        }
  
        const attributes = {};
        const bsKeys = Object.keys(element.dataset).filter(key => key.startsWith('bs') && !key.startsWith('bsConfig'));
  
        for (const key of bsKeys) {
          let pureKey = key.replace(/^bs/, '');
          pureKey = pureKey.charAt(0).toLowerCase() + pureKey.slice(1, pureKey.length);
          attributes[pureKey] = normalizeData(element.dataset[key]);
        }
  
        return attributes;
      },
  
      getDataAttribute(element, key) {
        return normalizeData(element.getAttribute(`data-bs-${normalizeDataKey(key)}`));
      }
  
    };
  
    /**
     * --------------------------------------------------------------------------
     * Bootstrap (v5.2.3): util/config.js
     * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
     * --------------------------------------------------------------------------
     */
    /**
     * Class definition
     */
  
    class Config {
      // Getters
      static get Default() {
        return {};
      }
  
      static get DefaultType() {
        return {};
      }
  
      static get NAME() {
        throw new Error('You have to implement the static method "NAME", for each component!');
      }
  
      _getConfig(config) {
        config = this._mergeConfigObj(config);
        config = this._configAfterMerge(config);
  
        this._typeCheckConfig(config);
  
        return config;
      }
  
      _configAfterMerge(config) {
        return config;
      }
  
      _mergeConfigObj(config, element) {
        const jsonConfig = isElement$1(element) ? Manipulator.getDataAttribute(element, 'config') : {}; // try to parse
  
        return { ...this.constructor.Default,
          ...(typeof jsonConfig === 'object' ? jsonConfig : {}),
          ...(isElement$1(element) ? Manipulator.getDataAttributes(element) : {}),
          ...(typeof config === 'object' ? config : {})
        };
      }
  
      _typeCheckConfig(config, configTypes = this.constructor.DefaultType) {
        for (const property of Object.keys(configTypes)) {
          const expectedTypes = configTypes[property];
          const value = config[property];
          const valueType = isElement$1(value) ? 'element' : toType(value);
  
          if (!new RegExp(expectedTypes).test(valueType)) {
            throw new TypeError(`${this.constructor.NAME.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
          }
        }
      }
  
    }
  