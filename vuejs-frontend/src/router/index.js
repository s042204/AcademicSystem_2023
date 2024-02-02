import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import MainDashboard from '../views/MainDashboard.vue'
import StudentDashboard from '../components/StudentDashboard.vue'
import TeacherDashboard from '../components/TeacherDashboard.vue'
import AdminDashboard from '../components/AdminDashboard.vue'
import LoginForm from '@/components/LoginForm'
import UserProfile from '@/components/UserProfile'  

const routes = [

  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: MainDashboard
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
  path: '/login',
  name: 'Login',
  component: LoginForm
  },
  {
    path: '/profile',
    name: 'Profile',
    component: UserProfile
  },
  {
    path: '/admin',
    name: 'Admin',
    component: AdminDashboard,
  }
  ,
  {
    path: '/teacher',
    name: 'Teacher',
    component: TeacherDashboard,
  }
  ,
  {
    path: '/student',
    name: 'Student',
    component: StudentDashboard,
  }
];
const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
