import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './singleMeta/app';

if (document.getElementById('reactMetabox')) {
	const reactMetabox = document.getElementById('reactMetabox');
	const metaRendered = createRoot(reactMetabox);
	metaRendered.render(<App />);
}
