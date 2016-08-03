(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"auth\/login","name":null,"action":"Softage\Http\Controllers\Auth\AuthController@getLogin"},{"host":null,"methods":["POST"],"uri":"auth\/login","name":null,"action":"Softage\Http\Controllers\Auth\AuthController@postLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"auth\/logout","name":null,"action":"Softage\Http\Controllers\Auth\AuthController@getLogout"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/index","name":"betting.index","action":"Softage\Http\Controllers\DefaultController@index"},{"host":null,"methods":["POST"],"uri":"betting\/dashboard","name":"betting.dashboard","action":"Softage\Http\Controllers\DefaultController@dashboard"},{"host":null,"methods":["POST"],"uri":"betting\/resultVendas","name":"betting.resultVendas","action":"Softage\Http\Controllers\DefaultController@resultadosVendas"},{"host":null,"methods":["POST"],"uri":"betting\/allTipoCotacao","name":"betting.allTipoCotacao","action":"Softage\Http\Controllers\DefaultController@allTipoCotacao"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/parametro\/index","name":"betting.parametro.index","action":"Softage\Http\Controllers\ParametrosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/parametro\/grid","name":"betting.parametro.grid","action":"Softage\Http\Controllers\ParametrosController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/parametro\/create","name":"betting.parametro.create","action":"Softage\Http\Controllers\ParametrosController@create"},{"host":null,"methods":["POST"],"uri":"betting\/parametro\/store","name":"betting.parametro.store","action":"Softage\Http\Controllers\ParametrosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/parametro\/save","name":"betting.parametro.save","action":"Softage\Http\Controllers\ParametrosController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/parametro\/update\/{id}","name":"betting.parametro.update","action":"Softage\Http\Controllers\ParametrosController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/area\/index","name":"betting.area.index","action":"Softage\Http\Controllers\AreasController@index"},{"host":null,"methods":["POST"],"uri":"betting\/area\/grid","name":"betting.area.grid","action":"Softage\Http\Controllers\AreasController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/area\/create","name":"betting.area.create","action":"Softage\Http\Controllers\AreasController@create"},{"host":null,"methods":["POST"],"uri":"betting\/area\/store","name":"betting.area.store","action":"Softage\Http\Controllers\AreasController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/area\/edit\/{id}","name":"betting.area.edit","action":"Softage\Http\Controllers\AreasController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/area\/update\/{id}","name":"betting.area.update","action":"Softage\Http\Controllers\AreasController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/area\/delete\/{id}","name":"betting.area.delete","action":"Softage\Http\Controllers\AreasController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/vendedor\/index","name":"betting.vendedor.index","action":"Softage\Http\Controllers\VendedorController@index"},{"host":null,"methods":["POST"],"uri":"betting\/vendedor\/grid","name":"betting.vendedor.grid","action":"Softage\Http\Controllers\VendedorController@grid"},{"host":null,"methods":["POST"],"uri":"betting\/vendedor\/gridConfig\/{id}","name":"betting.vendedor.gridConfig","action":"Softage\Http\Controllers\VendedorController@gridConfig"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/vendedor\/create","name":"betting.vendedor.create","action":"Softage\Http\Controllers\VendedorController@create"},{"host":null,"methods":["POST"],"uri":"betting\/vendedor\/store","name":"betting.vendedor.store","action":"Softage\Http\Controllers\VendedorController@store"},{"host":null,"methods":["POST"],"uri":"betting\/vendedor\/storeConfig","name":"betting.vendedor.storeConfig","action":"Softage\Http\Controllers\VendedorController@storeConfig"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/vendedor\/edit\/{id}","name":"betting.vendedor.edit","action":"Softage\Http\Controllers\VendedorController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/vendedor\/update\/{id}","name":"betting.vendedor.update","action":"Softage\Http\Controllers\VendedorController@update"},{"host":null,"methods":["POST"],"uri":"betting\/vendedor\/updateConfig","name":"betting.vendedor.updateConfig","action":"Softage\Http\Controllers\VendedorController@updateConfig"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/vendedor\/zerar\/{id}","name":"betting.vendedor.zerar","action":"Softage\Http\Controllers\VendedorController@zerar"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/arrecadador\/index","name":"betting.arrecadador.index","action":"Softage\Http\Controllers\ArrecadadorController@index"},{"host":null,"methods":["POST"],"uri":"betting\/arrecadador\/grid","name":"betting.arrecadador.grid","action":"Softage\Http\Controllers\ArrecadadorController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/arrecadador\/create","name":"betting.arrecadador.create","action":"Softage\Http\Controllers\ArrecadadorController@create"},{"host":null,"methods":["POST"],"uri":"betting\/arrecadador\/store","name":"betting.arrecadador.store","action":"Softage\Http\Controllers\ArrecadadorController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/arrecadador\/edit\/{id}","name":"betting.arrecadador.edit","action":"Softage\Http\Controllers\ArrecadadorController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/arrecadador\/update\/{id}","name":"betting.arrecadador.update","action":"Softage\Http\Controllers\ArrecadadorController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/arrecadador\/delete\/{id}","name":"betting.arrecadador.delete","action":"Softage\Http\Controllers\ArrecadadorController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/partidas\/index","name":"betting.partidas.index","action":"Softage\Http\Controllers\PartidasController@index"},{"host":null,"methods":["POST"],"uri":"betting\/partidas\/grid","name":"betting.partidas.grid","action":"Softage\Http\Controllers\PartidasController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/partidas\/create","name":"betting.partidas.create","action":"Softage\Http\Controllers\PartidasController@create"},{"host":null,"methods":["POST"],"uri":"betting\/partidas\/store","name":"betting.partidas.store","action":"Softage\Http\Controllers\PartidasController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/partidas\/edit\/{id}","name":"betting.partidas.edit","action":"Softage\Http\Controllers\PartidasController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/partidas\/update\/{id}","name":"betting.partidas.update","action":"Softage\Http\Controllers\PartidasController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/partidas\/destroy\/{id}","name":"betting.partidas.edit","action":"Softage\Http\Controllers\PartidasController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/partidas\/getPartidas","name":"betting.partidas.getPartidas","action":"Softage\Http\Controllers\PartidasController@getPartidas"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidades\/index","name":"betting.modalidades.index","action":"Softage\Http\Controllers\ModalidadesController@index"},{"host":null,"methods":["POST"],"uri":"betting\/modalidades\/grid","name":"betting.modalidades.grid","action":"Softage\Http\Controllers\ModalidadesController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidades\/create","name":"betting.modalidades.create","action":"Softage\Http\Controllers\ModalidadesController@create"},{"host":null,"methods":["POST"],"uri":"betting\/modalidades\/store","name":"betting.modalidades.store","action":"Softage\Http\Controllers\ModalidadesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidades\/edit\/{id}","name":"betting.modalidades.edit","action":"Softage\Http\Controllers\ModalidadesController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/modalidades\/update\/{id}","name":"betting.modalidades.update","action":"Softage\Http\Controllers\ModalidadesController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidades\/destroy\/{id}","name":"betting.modalidades.edit","action":"Softage\Http\Controllers\ModalidadesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidades\/getModalidade\/{id}","name":"betting.modalidades.getModalidade","action":"Softage\Http\Controllers\ModalidadesController@getModalidade"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/cotacoes\/index","name":"betting.cotacoes.index","action":"Softage\Http\Controllers\CotacoesController@index"},{"host":null,"methods":["POST"],"uri":"betting\/cotacoes\/grid","name":"betting.cotacoes.grid","action":"Softage\Http\Controllers\CotacoesController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/cotacoes\/create","name":"betting.cotacoes.create","action":"Softage\Http\Controllers\CotacoesController@create"},{"host":null,"methods":["POST"],"uri":"betting\/cotacoes\/store","name":"betting.cotacoes.store","action":"Softage\Http\Controllers\CotacoesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/cotacoes\/edit\/{id}","name":"betting.cotacoes.edit","action":"Softage\Http\Controllers\CotacoesController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/cotacoes\/update\/{id}","name":"betting.cotacoes.update","action":"Softage\Http\Controllers\CotacoesController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/cotacoes\/destroy\/{id}","name":"betting.cotacoes.edit","action":"Softage\Http\Controllers\CotacoesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/gols\/index","name":"betting.gols.index","action":"Softage\Http\Controllers\GolsController@index"},{"host":null,"methods":["POST"],"uri":"betting\/gols\/grid\/{idPartida}","name":"betting.gols.grid","action":"Softage\Http\Controllers\GolsController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/gols\/create","name":"betting.gols.create","action":"Softage\Http\Controllers\GolsController@create"},{"host":null,"methods":["POST"],"uri":"betting\/gols\/store","name":"betting.gols.store","action":"Softage\Http\Controllers\GolsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/gols\/edit\/{id}","name":"betting.gols.edit","action":"Softage\Http\Controllers\GolsController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/gols\/update\/{id}","name":"betting.gols.update","action":"Softage\Http\Controllers\GolsController@update"},{"host":null,"methods":["DELETE"],"uri":"betting\/gols\/delete\/{id}","name":"betting.gols.delete","action":"Softage\Http\Controllers\GolsController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/gols\/getTimes","name":"betting.gols.getTimes","action":"Softage\Http\Controllers\GolsController@getTimes"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/gols\/getResultado\/{idPartida}","name":"betting.gols.getResultado","action":"Softage\Http\Controllers\GolsController@getResultado"},{"host":null,"methods":["PUT"],"uri":"betting\/gols\/conclude\/{idPartida}","name":"betting.gols.conclude","action":"Softage\Http\Controllers\GolsController@conclude"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidade\/index","name":"betting.modalidade.index","action":"Softage\Http\Controllers\ModalidadeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidade\/grid","name":"betting.modalidade.grid","action":"Softage\Http\Controllers\ModalidadeController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidade\/create","name":"betting.modalidade.create","action":"Softage\Http\Controllers\ModalidadeController@create"},{"host":null,"methods":["POST"],"uri":"betting\/modalidade\/store","name":"betting.modalidade.store","action":"Softage\Http\Controllers\ModalidadeController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/modalidade\/edit\/{id}","name":"betting.modalidade.edit","action":"Softage\Http\Controllers\ModalidadeController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/modalidade\/update\/{id}","name":"betting.modalidade.update","action":"Softage\Http\Controllers\ModalidadeController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/resultado\/index","name":"betting.resultado.index","action":"Softage\Http\Controllers\ResultadoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/resultado\/grid","name":"betting.resultado.grid","action":"Softage\Http\Controllers\ResultadoController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/resultado\/create","name":"betting.resultado.create","action":"Softage\Http\Controllers\ResultadoController@create"},{"host":null,"methods":["POST"],"uri":"betting\/resultado\/store","name":"betting.resultado.store","action":"Softage\Http\Controllers\ResultadoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/resultado\/edit\/{id}","name":"betting.resultado.edit","action":"Softage\Http\Controllers\ResultadoController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/resultado\/update\/{id}","name":"betting.resultado.update","action":"Softage\Http\Controllers\ResultadoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/timesAlta\/index","name":"betting.timesAlta.index","action":"Softage\Http\Controllers\TimesAltaController@index"},{"host":null,"methods":["POST"],"uri":"betting\/timesAlta\/grid","name":"betting.timesAlta.grid","action":"Softage\Http\Controllers\TimesAltaController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/timesAlta\/create","name":"betting.timesAlta.create","action":"Softage\Http\Controllers\TimesAltaController@create"},{"host":null,"methods":["POST"],"uri":"betting\/timesAlta\/store","name":"betting.timesAlta.store","action":"Softage\Http\Controllers\TimesAltaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/timesAlta\/delete\/{id}","name":"betting.timesAlta.delete","action":"Softage\Http\Controllers\TimesAltaController@delete"},{"host":null,"methods":["POST"],"uri":"betting\/report\/reportFinanceiroSum","name":"betting.report.reportFinanceiroSum","action":"Softage\Http\Controllers\ReportFinanceiroController@reportFinanceiroSum"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/reportFinanceiroView","name":"betting.report.reportFinanceiroView","action":"Softage\Http\Controllers\ReportFinanceiroController@reportFinanceiroView"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/gridReportFinanceiro","name":"betting.report.gridReportFinanceiro","action":"Softage\Http\Controllers\ReportFinanceiroController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/reportPartidasView","name":"betting.report.reportPartidasView","action":"Softage\Http\Controllers\ReportPartidasController@reportPartidasView"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/getReportPartidas","name":"betting.report.getReportPartidas","action":"Softage\Http\Controllers\ReportPartidasController@getReportPartidas"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/getPartidasReport","name":"betting.report.getPartidasReport","action":"Softage\Http\Controllers\CotacoesController@getPartidas"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/reportVendasView","name":"betting.report.reportVendasView","action":"Softage\Http\Controllers\ReportVendasController@reportVendasView"},{"host":null,"methods":["POST"],"uri":"betting\/report\/reportVendasSearch","name":"betting.report.reportVendasSearch","action":"Softage\Http\Controllers\ReportVendasController@reportVendasSearch"},{"host":null,"methods":["POST"],"uri":"betting\/report\/reportVendasSum","name":"betting.report.reportVendasSum","action":"Softage\Http\Controllers\ReportVendasController@querySum"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/cupomVendas\/{d}","name":"betting.report.cupomVendas","action":"Softage\Http\Controllers\ReportVendasController@cupomVendas"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/reportApostasView","name":"betting.report.reportApostasView","action":"Softage\Http\Controllers\ReportApostasController@reportApostasView"},{"host":null,"methods":["POST"],"uri":"betting\/report\/reportApostasSearch","name":"betting.report.reportApostasSearch","action":"Softage\Http\Controllers\ReportApostasController@reportApostasSearch"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/report\/reportArrecadacoesView","name":"betting.report.reportArrecadacoesView","action":"Softage\Http\Controllers\ReportArrecadacoesController@reportArrecadacoesView"},{"host":null,"methods":["POST"],"uri":"betting\/report\/reportArrecadacoesSearch","name":"betting.report.reportArrecadacoesSearch","action":"Softage\Http\Controllers\ReportArrecadacoesController@reportArrecadacoesSearch"},{"host":null,"methods":["POST"],"uri":"betting\/report\/reportArrecadacoesSum","name":"betting.report.reportArrecadacoesSum","action":"Softage\Http\Controllers\ReportArrecadacoesController@querySum"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/user\/index","name":"betting.user.index","action":"Softage\Http\Controllers\UserController@index"},{"host":null,"methods":["POST"],"uri":"betting\/user\/grid","name":"betting.user.grid","action":"Softage\Http\Controllers\UserController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/user\/create","name":"betting.user.create","action":"Softage\Http\Controllers\UserController@create"},{"host":null,"methods":["POST"],"uri":"betting\/user\/store","name":"betting.user.store","action":"Softage\Http\Controllers\UserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/user\/edit\/{id}","name":"betting.user.edit","action":"Softage\Http\Controllers\UserController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/user\/update\/{id}","name":"betting.user.update","action":"Softage\Http\Controllers\UserController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/role\/index","name":"betting.role.index","action":"Softage\Http\Controllers\RoleController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/role\/grid","name":"betting.role.grid","action":"Softage\Http\Controllers\RoleController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/role\/create","name":"betting.role.create","action":"Softage\Http\Controllers\RoleController@create"},{"host":null,"methods":["POST"],"uri":"betting\/role\/store","name":"betting.role.store","action":"Softage\Http\Controllers\RoleController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"betting\/role\/edit\/{id}","name":"betting.role.edit","action":"Softage\Http\Controllers\RoleController@edit"},{"host":null,"methods":["POST"],"uri":"betting\/role\/update\/{id}","name":"betting.role.update","action":"Softage\Http\Controllers\RoleController@update"},{"host":null,"methods":["POST"],"uri":"betting\/util\/search","name":"betting.util.search","action":"Softage\Http\Controllers\UtilController@search"},{"host":null,"methods":["POST"],"uri":"betting\/util\/select2","name":"betting.util.select2","action":"Softage\Http\Controllers\UtilController@queryByselect2"}],
            prefix: '/public/index.php',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

