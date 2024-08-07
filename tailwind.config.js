export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    './node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx,vue}',
    './node_modules/flowbite/**/*.{js,jsx,ts,tsx}'
  ],
  theme: {
    extend: {
      colors: {
        "darkTeal": "#0D1B1A",
        "darkSlate": "#254441",
        "zomp": "#43AA8B",
        "keppel": "#44BBA4",
        "ivory": "#FAFFF5"
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}