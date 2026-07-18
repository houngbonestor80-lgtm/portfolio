module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        display: ['"Sora"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        sans: ['"Inter"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      colors: {
        sand: {
          50: '#fefdfb',
          100: '#faf6ee',
          200: '#f2ead9',
          300: '#e4d6ba',
        },
        ink: {
          950: '#0e1712',
          900: '#12211a',
          800: '#1a2e23',
          700: '#22392c',
        },
        green: {
          50: '#eafbf1',
          100: '#cdf5dd',
          200: '#9ce9bf',
          300: '#63d69b',
          400: '#34bd7c',
          500: '#189a61',
          600: '#0f7a4c',
          700: '#0c5f3d',
          800: '#0a4b31',
          900: '#083c28',
        },
        gold: {
          50: '#fffaeb',
          100: '#fff1c2',
          200: '#ffe185',
          300: '#fdcd4c',
          400: '#fcd116',
          500: '#e0ad0a',
          600: '#b6870a',
          700: '#8c650e',
          800: '#734f12',
          900: '#5c3f13',
        },
      },
      boxShadow: {
        soft: '0 2px 10px -2px rgba(15, 40, 25, 0.08), 0 12px 32px -12px rgba(15, 40, 25, 0.12)',
        gold: '0 0 0 1px rgba(252,209,22,0.3), 0 16px 40px -18px rgba(15,40,25,0.35)',
      },
      backgroundImage: {
        'gold-gradient': 'linear-gradient(135deg, #fdcd4c 0%, #e0ad0a 100%)',
        'green-gradient': 'linear-gradient(135deg, #34bd7c 0%, #0c5f3d 100%)',
      },
    },
  },
  plugins: [require('@tailwindcss/forms')],
}
