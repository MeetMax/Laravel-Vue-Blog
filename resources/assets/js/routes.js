import Home from './views/home/home.vue'
import Dashboard from './views/dashboard.vue'
import Article from './views/article/article.vue'
import Comment from './views/comment/comment.vue'
import Category from './views/category/category.vue'
import Tag from './views/tag/tag.vue'
import Discussion from './views/discussion/discussion.vue'
import User from  './views/user/user.vue'
import ArticleCreate from './views/article/create.vue'
import ArticleEdit from './views/article/edit.vue'
import CategoryCreate from './views/category/create.vue'
import CategoryEdit from './views/category/edit.vue'
import TagEdit from './views/tag/edit.vue'
import TagCreate from './views/tag/create.vue'
import UserCreate from './views/user/create.vue'
import UserEdit from './views/user/edit.vue'
import DiscussionCreate from './views/discussion/create.vue'
import DiscussionEdit from './views/discussion/edit.vue'
import CommentCreate from './views/comment/create.vue'
import CommentEdit from './views/comment/edit.vue'
import ImageCreate from './views/image/create.vue'
import Image from './views/image/image.vue'
export default[
    {
        path: '/dashboard',
        component: Dashboard,
        children: [
            {
                path: '/',
                redirect: '/dashboard/home',
            },
            {
                path: 'home',
                component: Home,
                name:'home'
            },
            {
                path:'article',
                component:Article,
                name:'article'
            },
            {
                path:'comment',
                component:Comment,
                name:'comment'
            },
            {
                path:'category',
                component:Category,
                name:'category'
            },
            {
                path:'tag',
                component:Tag,
                name:'tag'
            },
            {
                path:'discussion',
                component:Discussion,
                name:'discussion'
            },
            {
                path:'user',
                component:User,
                name:'user'
            },
            {
                path:'create-user',
                component:UserCreate,
                name:'create-user'
            },
            {
                path:'edit-user/:id',
                component:UserEdit,
                name:'edit-user'
            },
            {
                path:'create-article',
                component:ArticleCreate,
                name:'create-article'
            },
            {
                path:'edit-article/:id',
                component:ArticleEdit,
                name:'edit-article'
            },
            {
                path:'create-category',
                component:CategoryCreate,
                name:'create-category'
            },
            {
                path:'edit-category/:id',
                component:CategoryEdit,
                name:'edit-category'
            },
            {
                path:'edit-tag/:id',
                component:TagEdit,
                name:'edit-tag'
            },
            {
                path:'create-tag',
                component:TagCreate,
                name:'create-tag'
            },
            {
                path:'edit-discussion/:id',
                component:DiscussionEdit,
                name:'edit-discussion'
            },
            {
                path:'create-discussion',
                component:DiscussionCreate,
                name:'create-discussion'
            },
            {
                path:'create-comment',
                component:CommentCreate,
                name:'create-comment'
            },
            {
                path:'edit-comment/:id',
                component:CommentEdit,
                name:'edit-comment'
            },
            {
                path:'image',
                component:Image,
                name:'image'
            },
            {
                path:'create-image',
                component:ImageCreate,
                name:'create-image'
            }
        ]
    },
    {
        path:'storage/:name',
        component:ImageCreate,
        name:'create-image'
    }

]


