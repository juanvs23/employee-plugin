import { useState, useRef, useEffect } from 'react';
import DaysComponent from './daysComponent';

export default function DateRange({ name, data }) {
	const startTimeRef = useRef();
	const endTimeRef = useRef();
	const jornalRef = useRef();
	const [workTime, setWorkTime] = useState(data);
	const [days, setDays] = useState(data.days);
	const handlerChange = () => {
		const start = startTimeRef.current.value,
			end = endTimeRef.current.value,
			jornal = jornalRef.current.value;
		setWorkTime({ inicio: start, fin: end, jornal, days: days });
	};
	useEffect(() => {
		handlerChange();
	}, [days.length]);
	return (
		<div className='row'>
			<input type='hidden' name={name} value={JSON.stringify(workTime)} />
			<div className='col-3'>
				<label htmlFor={`start_${name}`} className='d-block'>
					<span>Fecha de inicio</span>
				</label>
				<input
					ref={startTimeRef}
					onChange={handlerChange}
					className='form-control'
					type='time'
					defaultValue={workTime.inicio}
					id={`start_${name}`}
				/>
			</div>
			<div className='col-3'>
				<label htmlFor={`end_${name}`} className='d-block'>
					<span>Fecha de Final</span>
				</label>
				<input
					ref={endTimeRef}
					onChange={handlerChange}
					className='form-control'
					type='time'
					defaultValue={workTime.fin}
					id={`end_${name}`}
				/>
			</div>
			<div className='col-3'>
				<fieldset>
					<legend>
						<span style={{ display: 'block' }}>Dias laborales</span>
					</legend>

					{[
						'lunes',
						'martes',
						'miercoles',
						'jueves',
						'viernes',
						'sabado',
						'domingo',
					].map((day, i) => (
						<DaysComponent
							key={i}
							currentDay={day}
							days={days}
							setDay={setDays}
						/>
					))}
				</fieldset>
			</div>
			<div className='col-3'>
				<label className='form-check-label' htmlFor={`${name}jornada`}>
					Tipo de jornada
				</label>
				<select
					className='form-select form-select-sm'
					id={`${name}jornada`}
					ref={jornalRef}
					onChange={handlerChange}
					defaultValue={workTime.jornal}
					aria-label='.form-select-sm example'>
					<option>Seleccione una opción</option>
					<option value='1'>Jornada completa</option>
					<option value='2'>Media jornada</option>
					<option value='3'>Por hora</option>
					<option value='4'>Freelance</option>
				</select>
			</div>
		</div>
	);
}
