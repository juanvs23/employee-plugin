import { useState, useRef } from 'react';

export default function TimeModule({ name, title, expired }) {
	const dateRef = useRef();
	const [workTime, setWorkTime] = useState(expired ? expired : '');
	const handlerChange = () => {
		const date = new Date(dateRef.current.value).getTime();
		const now = new Date().getTime();
		console.log(date, now);
		if (date.getTime() > now.getTime()) {
		}
	};
	const duration =
		workTime != '' ? <p className='new-time'>{workTime}</p> : null;
	return (
		<div className='row'>
			<div className='col-4'>
				<label htmlFor={`${name}`} className='d-block'>
					<span>Fecha límite de postulación</span>
				</label>
				<input
					onChange={handlerChange}
					ref={dateRef}
					className='form-control'
					type='date'
					defaultValue={expired}
					name={`${name}`}
					id={`${name}`}
				/>
			</div>
			<div className='col-4'></div>
			<div className='col-4'>
				<span className='d-block'>Fecha limite</span>
				{duration}
			</div>
		</div>
	);
}
