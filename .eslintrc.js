module.exports = {
	env: {
		browser: true,
		es2021: true,
		node: true,
	},
	extends: [
		'eslint:recommended',
		'plugin:react/recommended',
		'plugin:prettier/recommended',
	],
	parserOptions: {
		ecmaFeatures: {
			jsx: true,
		},
		ecmaVersion: 'latest',
		sourceType: 'module',
	},
	plugins: ['react', 'prettier'],
	rules: {
		'prettier/prettier': [
			'error',
			{
				trailingComma: 'es5',
				useTabs: true,
				semi: true,
				singleQuote: true,
				bracketSpacing: true,
				bracketSameLine: true,
				jsxSingleQuote: true,
			},
		],
		indent: ['error', 'tab'],
	},
};
