import { useState, useRef } from 'react';
import './checkboxInput.scss';

export default function CheckboxInput({ name, title, jobData }) {
	const [state, setState] = useState(jobData);

	return (
		<div className='row'>
			<div className='col-4'>
				<label htmlFor={`${name}-input`}>
					<h3 style={{ marginTop: '0px' }}>{title}</h3>
				</label>
			</div>
			<div className='col-8'>
				<div className='form-check form-switch'>
					<input
						className='form-check-input'
						type='checkbox'
						role='switch'
						checked={state}
						onChange={() => setState((state) => !state)}
						name={`${name}`}
						id='flexSwitchCheckDefault'
					/>
				</div>
			</div>
		</div>
	);
}
