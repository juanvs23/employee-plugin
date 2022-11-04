import DateRange from './DateRange';
import TimeModule from './TimeModule';
import './dateTimefield.scss';

export default function DateTimeField({
	name,
	title,
	buttonTitle,
	type,
	jobData,
}) {
	return (
		<div className='row'>
			<div className='col-3'>
				<label htmlFor={`${name}-intput`}>
					<h3 style={{ marginTop: '0px' }}>{title}</h3>
				</label>
			</div>
			<div className='col-9'>
				{type == 'dateRange' ? (
					<DateRange name={name} data={jobData} title={title} />
				) : (
					<TimeModule name={name} title={title} expired={jobData} />
				)}
			</div>
		</div>
	);
}
