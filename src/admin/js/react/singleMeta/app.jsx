import CheckboxInput from './components/checkboxInput';
import DateTimeField from './components/dateTimefield';
import Requirements from './components/requirement';

export default function App() {
	return (
		<div className='metacontainer'>
			<Requirements
				name='requirement'
				title={'Requisitos mínimos'}
				buttonTitle={'Agregar requisitos'}
				jobData={job_requirement}
			/>
			<Requirements
				name='whitlist'
				title={'Requisitos deseados'}
				buttonTitle={'Agregar requisitos'}
				jobData={job_whitlist}
			/>
			<Requirements
				name='languages'
				title={'Idiomas Requeridos'}
				buttonTitle={'Agregar idioma'}
				jobData={job_languages}
			/>
			<DateTimeField
				name='workTime'
				title={'Horario laboral'}
				buttonTitle={'Agregar horario'}
				type='dateRange'
				jobData={job_workTime}
			/>
			<DateTimeField
				name='expireTime'
				title={'Fecha límite de postulación'}
				type='time'
				jobData={job_expireTime}
			/>
			<CheckboxInput
				name='active-offer'
				title={'Postulación activa'}
				jobData={active_offer}
			/>
		</div>
	);
}
