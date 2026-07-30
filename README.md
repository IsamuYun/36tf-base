# 36TF Base

面向中小企业官网的极简 block theme 骨架。为 WordPress 7.0 / PHP 8.3 编写。

一套代码，两个品牌：默认样式是 **36 Tech Freedom**，`styles/fire-blocker.json` 是 **Fire Blocker Material** 的样式变体。换品牌 = 在站点编辑器里点一下样式，不改任何代码。

---

## 0. 安装

**方式一 · 从 GitHub 一键安装（推荐）**

1. GitHub 仓库页 → Code → Download ZIP（或某个 Release 的 zip）
2. WordPress 后台 → 外观 → 主题 → 安装主题 → 上传主题 → 选这个 zip → 立即安装 → 启用

字体（5 个 `woff2`）已经随主题一起进仓库，**下载即用**，无需再跑任何脚本或配置 CDN。

**方式二 · 直接拷贝目录**

```bash
cp -r 36tf-base /path/to/wp-content/themes/
```

后台 → 外观 → 主题 → 启用「36TF Base」。

字体通过 `theme.json` 的 `fontFace` 声明注册（`assets/fonts/*.woff2`），会自动出现在站点编辑器的「字体库」里。万一交付时删掉了字体二进制，也只是回退到系统字体栈，**不会产生 404**。

---

## 1. 目录结构

```
theme.json          ★ 设计令牌。颜色/字号/间距/区块默认样式全在这里。改样式先改这个文件。
styles/             样式变体。fire-blocker.json = 客户站配色 + 字体。
templates/          页面模板（.html，区块标记）
parts/              模板片段：header / footer / cta
patterns/           区块模式。WordPress 自动扫描注册，不需要手写 register 调用。
inc/                PHP：主题支持、字体、CPT、pattern 分类、区块样式、Woo 适配
assets/css/theme.css  唯一的补充样式表。只写 theme.json 表达不了的东西。
```

**纪律**：能进 `theme.json` 的一律进 `theme.json`。一旦开始往 `theme.css` 里写颜色和间距，就退化成「用 FSE 写传统主题」，最后两套样式系统互相打架。

---

## 2. 建站清单（10 个核心页面）

### 2.1 先建内容骨架

后台 → 页面 → 新建，一次性建好这 8 个 Page（内容留空）：

| 标题 | 别名（slug） | 模板 | 说明 |
|---|---|---|---|
| Home | `home` | 默认 | 建完后到「设置 → 阅读」设为静态首页 |
| Services | `services` | 默认 | |
| FAQ | `faq` | 默认 | |
| About | `about` | 默认 | |
| Contact Us | `contact` | 默认 | |
| Help Me Choose A Product! | `help-me-choose` | 页面 · 通栏（无标题） | |
| Blog | `blog` | 默认 | 「设置 → 阅读」里设为文章页 |
| Privacy Policy | `privacy-policy` | 默认 | Woo 结账页需要 |

**Gallery 和 Resources 不要建 Page** —— 它们是本主题注册的自定义内容类型，归档页地址已经是 `/gallery/` 和 `/resources/`，再建同名 Page 会撞车。

**Products 也不要建 Page** —— 装 WooCommerce 时它会自己建 Shop / Cart / Checkout / My Account 四个页面。把 Shop 页标题改成 Products、slug 改成 `products` 即可。

### 2.2 用 pattern 填内容

打开任一页面 → 插入器（+）→ 模式 → 找「36TF · 整页模板」：

- **Home** → 插入「整页 · Home（一键拼装）」，逐段替换文案
- **Help Me Choose A Product!** → 插入「整页 · Help Me Choose（选型引导 · 静态版）」
- **Contact Us** → 插入「整页 · Contact Us」，把表单插件的区块拖进右栏
- **FAQ** → 插入「内容区 · FAQ 折叠」，然后在 SEO 插件里为本页开启 FAQPage 结构化数据
- **Services / About** → 用「内容区 · 服务/能力三栏」起头，其余自由拼

### 2.3 导航菜单

外观 → 编辑器 → 模板片段 → 页头 → 点导航区块 → 建一个菜单。建议顺序：

```
Home  Products  Services  Gallery  Resources  About  Contact
                                              ↑ 二级放 FAQ / Blog
```

Help Me Choose 不放主导航 —— 它已经是首页 Hero 和全站 CTA 条的主按钮，主导航里再放一次会稀释。

### 2.4 内容录入

- **Gallery**：后台 → Gallery → 新增案例。填标题、摘要、特色图、「案例分类」、自定义字段 `tf_project_location`
- **Resources**：后台 → Resources → 新增资源。自定义字段 `tf_resource_file` 填 PDF 的 URL，单页上的「下载文件」按钮已经通过 Block Bindings 绑好了这个字段，无需 ACF

---

## 3. 换成 Fire Blocker Material

1. 外观 → 编辑器 → 样式 → 浏览样式 → 选「Fire Blocker Material」
2. 换 logo：外观 → 编辑器 → 页头 → 站点标志
3. 改站点标题：设置 → 常规
4. 字体：Fire Blocker 用的 `assets/fonts/archivo.woff2` 和 `ibm-plex-sans.woff2` 已随主题打包，切换样式变体即生效，无需另外放置

**样式变体本身是文件（`styles/fire-blocker.json`），不是数据库记录**，所以能进 Git、能跟着主题走。这也是为什么骨架要设计成「一套模板 + 多套令牌」，而不是复制两份主题。

真正交付给客户时，把主题目录复制一份改名（如 `fireblocker-theme`），把 `fire-blocker.json` 的内容合并进 `theme.json` 做默认值，删掉 36TF 那套。这样客户站里不会看到别的品牌的配色选项。

---

## 4. WooCommerce

**本主题刻意不提供 `single-product.html` / `archive-product.html`。**

原因：WooCommerce 自带的区块模板本身就引用了 `<!-- wp:template-part {"slug":"header"} -->`，也就是说它会自动套用本主题的页头页脚和 `theme.json` 令牌，开箱即用且样式一致。自己写一份反而是在跟 Woo 的模板更新赛跑。

正确的定制流程：

1. 装 WooCommerce，跑完设置向导
2. 装 **Create Block Theme** 插件（只在开发期用）
3. 站点编辑器 → 模板 → 找到 `Product Catalog` / `Single Product`，改到满意
4. Create Block Theme → 「导出」，把生成的 `templates/*.html` 放回主题目录
5. `git add` 提交

> ⚠️ **这是 FSE 最大的坑**：站点编辑器的所有修改存在数据库里（`wp_template` / `wp_template_part` / `wp_global_styles` 三个 CPT），**不是文件**。不导出就提交不了 Git，staging → production 只能整库搬，客户在生产环境改的内容会被冲掉。养成「改完就导出」的习惯。

`inc/woocommerce.php` 已经做了两件事：
- 声明主题级 Woo 支持（相册缩放/灯箱/滑动）
- **非电商页面卸载 Woo 的 CSS 和 cart-fragments**。默认 Woo 会在全站每一页加载这些，对一个只有 Products 一个分支用到电商的官网是纯浪费

### 「Help Me Choose」的筛选链接

`patterns/page-help-me-choose.php` 里的按钮指向 `/products/?filter_application=wall` 这类地址。要让它真的生效：

1. 在 Woo 里建商品属性：`application`（用途）、`rating`（耐火极限）、`substrate`（基材）
2. 每个商品勾选对应属性值
3. 商品归档页放一个「按属性筛选」区块（Filter by Attribute），URL 参数就会被识别

这是**静态 A 档方案**：零 JS、SEO 友好、每个组合都是可被索引的落地页。先用它跑 1–2 个月拿转化数据，再决定要不要升级成 Interactivity API 的交互版或 AI 导购。

---

## 5. 开发环境与版本控制

推荐 `wp-env`（Docker，配置即代码，能进 Git）：

```bash
npm -g i @wordpress/env
cd /path/to/project
cat > .wp-env.json <<'JSON'
{
  "core": "WordPress/WordPress#7.0",
  "phpVersion": "8.3",
  "themes": ["./36tf-base"],
  "plugins": ["https://downloads.wordpress.org/plugin/woocommerce.zip"]
}
JSON
wp-env start
```

Git 只跟踪**主题目录和自建插件**，不跟踪 WP 核心、`uploads/`、`vendor/`。数据库用 WP-CLI 导出：

```bash
wp db export --exclude_tables=wp_users,wp_usermeta
```

---

## 6. 上线前检查

- [x] 字体 woff2 已随主题打包在 `assets/fonts/`（默认已满足；除非刻意删除）
- [ ] 站点编辑器的所有修改已用 Create Block Theme 导出成文件并提交
- [ ] 固定链接刷新过一次（设置 → 固定链接 → 保存），`/gallery/` `/resources/` 能打开
- [ ] FAQ 页开启了 FAQPage 结构化数据；Contact 页开启 LocalBusiness
- [ ] 所有图片有 alt；键盘 Tab 能走通导航和选型引导
- [ ] Lighthouse：移动端性能 ≥ 90，无障碍 = 100
- [ ] `inc/blocks.php` 里的 `tf36_allowed_block_types` 按客户实际需要再收一收

---

## 7. 已知待办

这是骨架，不是成品。还没做的：

- `templates/archive-tf_project.html` 里的分类筛选行目前是占位，要么手工列分类链接，要么写一个小 block 自动输出 term 列表
- 没有 mega menu。真要做，参照独立方案：一级项走 WP 菜单 + 面板内容由 `product_cat` 动态渲染 + transient 缓存
- 没有多语言。要做中英双语时上 Polylang 或 WPML，注意 pattern 里的硬编码中文要过 `__()`
- 分页/归档的空状态文案还是占位，上线前按品牌口吻改一遍

> skip-link 不在待办里：block theme 下 WordPress 核心的 `wp_enqueue_block_template_skip_link()` 会自动输出「跳到内容」，`theme.css` 里的 `.skip-link` 只是给它套上本站配色。
