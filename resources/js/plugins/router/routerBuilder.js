import routes from './routes'
import store from '../../store';

const router = routes.map(route => {
    return {
        name: route.title,
        path: route.path,
        component: route.component,
        beforeEnter: route.permissions || route.authenticated ? function(to, from, next) {
            if (route.authenticated) {
                if (!store.getters['auth/authenticated']) {
                    next({name: 'main'});
                } else {
                    if (!route.blocked) {
                        if (store.getters['auth/user'].blocked) {
                            next({name: 'main'});
                        }
                    }
                }
            }

            if (route.permissions.length) {
                if (!store.getters['auth/can'](route.permissions)) {
                    next({name: 'main'});
                }
            }
            next();
        } : function(to, from, next) {
            next();
        }
    }
});

export default router;