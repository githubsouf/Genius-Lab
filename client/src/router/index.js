import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import store from '../store'; // Import your Vuex store

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/register-type',
    name: 'RegisterType',
    component: () => import('../views/RegisterType.vue')
  },
  {
    path: '/register-parent',
    name: 'RegisterParent',
    component: () => import('../views/RegisterParent.vue') // Assuming you have a RegisterParent.vue component
  },
  {
    path: '/register-animateur',
    name: 'RegisterAnimateur',
    component: () => import('../views/RegisterAnimateur.vue') // Assuming you have a RegisterAnimateur.vue component
  },
  {
    path: '/azertyuiop789456123',
    name: 'RegisterAnimateur',
    component: () => import('../views/adminlogin.vue') // Assuming you have a RegisterAnimateur.vue component
  },
  {
    path: '/about',
    name: 'about',
    // Lazy-loaded route
    component: () => import('../views/AboutView.vue')
  },
  {
    path: '/workshop',
    name: 'workshop',
    component: () => import('../views/workshop.vue')
  },
  {
    path: '/offers',
    name: 'offers',
    component: () => import('../views/OffersPage.vue')
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('../views/register.vue')
  },
  {
    path: '/dashboard/admin',
    name: 'adminDashboard',
    component: () => import('../dashboards/adminDashboard.vue'),
  },
  {
    path: '/dashboard/Calendar',
    name: 'Calendar',
    component: () => import('../dashboards/Calendar.vue'),
  },
  {
    path: '/dashboard/admin/newoffer',
    name: 'NewOffer',
    component: () => import('../dashboards/newoffer.vue'),  
  },
  {
    path: '/dashboard/admin/addworkshop',
    name: 'AddWorkshop',
    component: () => import('../dashboards/AddWorkshop.vue'),  
    
  },
  {
    path: '/dashboard/animateur',
    name: 'animateurDashboard',
    component: () => import('../dashboards/animdashboard.vue'),
  },
  {
    path: '/dashboard/adminWorkshop',
    name: 'adminWorkshopDashboard',
    component: () => import('../dashboards/adashboard.vue'),
    meta: { requiresAuth: true } // Add meta field to indicate this route requires authentication
  },
  {
    path: '/dashboard/parent',
    name: 'parentdashboard',
    component: () => import('../dashboards/parentdashboard.vue'),
  },
  {
    path: '/activities/:id',
    name: 'WorkshopDetail',
    component: () => import('../views/WorkshopDetail.vue')
  },
  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: () => import('../views/NotFound.vue')
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = store.getters.isAuthenticated;

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      // Redirect to login page if not authenticated
      next({ path: '/', query: { redirect: to.fullPath } });
    } else {
      next(); // Proceed to the route
    }
  } else {
    next(); // Allow access to non-protected routes
  }
});

export default router;
